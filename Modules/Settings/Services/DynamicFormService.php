<?php


namespace Modules\Settings\Services;


use App\Models\Navigation;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Entities\DynamicForm;
use Modules\Settings\Entities\DynamicFormEntry;
use function PHPUnit\Framework\isInstanceOf;

class DynamicFormService extends BaseService
{
    public function __construct(){}

    public function getAll()
    {
        return DynamicForm::with('department')->get();
    }

    function get($id)
    {
        return DynamicForm::with('formEntries','navigation')->find($id); #where('id',$id)->first();
    }

    function getAllFormEntries($id)
    {
        return DynamicFormEntry::where('dynamic_form_id',$id)->get();
    }

    function getFormListingData($formName,$softDelete=false)
    {
        $query = \DB::table($formName);
        if ($softDelete) {
            $query->whereNull('deleted_at');
        }
        return $query->get();
    }

    function getFormRecord($formName,$recordId)
    {
        return \DB::table($formName)->find($recordId);
    }

    function queryProduct($department_id=null)
    {
        $query = DynamicForm::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterDynamicForms($where=[],$statusOnly=false)
    {
        $query = DynamicForm::with('creator','navigation');
        if ($statusOnly) {
            $query->where($where);
        } else {
            $query->where($where);
        }
        return $query;
    }

    function recordExists($paramsArray)
    {
        return DynamicForm::where($paramsArray)->exists();
    }

    public function getDropdownOptions()
    {
        return DynamicForm::where('form_type',2)->get()->pluck('schema_name');
    }

    function create($params)
    {
        $user = Auth::user();
        $params['created_by'] = $user->id;
        $form = DynamicForm::create($params);

        $navigation = [
            'dynamic_form_id' => $form->id ?? 0,
            'name' => $params['node_name'],
            'parent_id' => $params['navigation_id'] ?? 2,
            'slug' => str_replace(' ', '-', strtolower($params['node_name'])),
            'type' => $params['allowed_operations'] == 'view' ? 'view-only' : $params['allowed_operations'],
//            'created_by' => $user->id,
        ];
//        $nav = Navigation::firstOrNew($navigation);
        $nav = Navigation::firstOrCreate($navigation);
//        dd($nav->toArray());
        $permissionNameArr = ['view','create','edit','del'];
        if (!is_null($nav)) {
            if ($nav->type == 'view-only') {
                $permissionArr = [
                    'name' => $nav->slug . '-view',
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                \Spatie\Permission\Models\Permission::findOrCreate($permissionArr['name']);
            } elseif ($nav->type == 'all') {
                foreach ($permissionNameArr as $permissionName) {
                    $permissionArr = [
                        'name' => $nav->slug . '-' . $permissionName,
                        'guard_name' => 'web',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    \Spatie\Permission\Models\Permission::findOrCreate($permissionArr['name']);
                }
            }
        }

        return $form;
    }

    function update($params,$id)
    {
        $user = Auth::user();
        $model = $this->get($id);
        $model->update([
            'name' => $params['node_name'],
            'parent_id' => $params['navigation_id'] ?? 2,
            'slug' => str_replace(' ', '-', strtolower($params['node_name'])),
            'allowed_operations' => $params['allowed_operations'] == 'view' ? 'view-only' : $params['allowed_operations'],
            'node_sort_order' => $params['node_sort_order'],
            'form_type' => $params['form_type'],
            'pagination' => $params['pagination'],
            'activate_workflow' => $params['activate_workflow'],
            'soft_delete' => $params['soft_delete'] ?? 0,
        ]);

        $oldFormEntries = $model->formEntries;
        if (sizeof($params['field_name']) > 0) {
            foreach ($params['field_name'] as $i => $fieldName) {
                if (!$oldFormEntries->contains('field_name', $fieldName)) {
                    $formEntry = [
                        'dynamic_form_id' => $id,
                        'field_name' => $fieldName,
                        'field_type' => $params['field_type'][$i],
                        'field_length' => $params['field_length'][$i],
                        'control_type' => $params['control_type'][$i],
                        'checklist' => $params['checklist'][$i] ?? null,
                        'label_name' => $params['label_name'][$i],
                        'created_by' => $user->id,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    DynamicFormEntry::create($formEntry);
                } else {
                   DynamicFormEntry::where([
                       'dynamic_form_id' => $id,
                       'field_name' => $fieldName
                   ])->update([
                       'field_type' => $params['field_type'][$i],
                       'field_length' => $params['field_length'][$i],
                       'control_type' => $params['control_type'][$i],
                       'checklist' => $params['checklist'][$i] ?? null,
                       'label_name' => $params['label_name'][$i],
                       'updated_by' => $user->id,
                   ]);
                }
            }
//            $model->formEntries($formEntries);
        }
        return $model;
    }

    function storeFormData($data,$formId)
    {
        $form = DynamicForm::find($formId);
        $checklist = $form->formEntriesCheckbox;
        if ($checklist->count()) {
            foreach ($checklist as $list) {
                $data[$list->field_name] = implode(',', $data[$list->field_name]);
            }
        }
//        return ($form->schema_name)::create($data);
        return \DB::table($form->schema_name)->insert($data);
    }

    function updateFormData($data,$form)
    {
//        $form = DynamicForm::find($formId);
        $id = $data['id']; unset($data['id']);
        $checklist = $form->formEntriesCheckbox;
        if ($checklist->count()) {
            foreach ($checklist as $list) {
                $data[$list->field_name] = implode(',', $data[$list->field_name]);
            }
        }
        return \DB::table($form->schema_name)->where('id', $id)
            ->update($data);
    }

    function deleteFormEntry($data,$formId)
    {
        $form = DynamicForm::find($formId);
        $id = $data['id']; unset($data['id']);
        if ($form->soft_delete) {
            $data['deleted_at'] = date('Y-m-d H:i:s');
            \DB::table($form->schema_name)->where('id', $id)
                ->update($data);
        } else {
            \DB::table($form->schema_name)->where('id', $id)
                ->delete();
        }
        return $form;
    }
}
