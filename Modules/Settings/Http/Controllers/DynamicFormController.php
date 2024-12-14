<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Modules\Settings\Http\Requests\BudgetTypeRequest;
use Modules\Settings\Services\DynamicFormService;
use Yajra\DataTables\Facades\DataTables;

class DynamicFormController extends Controller
{
    protected $__settingService;

    public function __construct(DynamicFormService $dynamicFormService)
    {
        $this->middleware('auth');
        $this->__settingService = $dynamicFormService;
        $this->data['routePrefix'] = 'dynamic_forms.';
        $this->data['title'] = __('label.dynamic_forms');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->data['title'] = 'Dynamic Forms';
        $this->data['rows'] = null; #$this->__settingService->getAll();
        return view('settings::dynamic_forms.index', $this->data);
    }

    public function getDatatableList(Request $request)
    {
        $searchFilter = [];
        if ($request->name != '') {
            $searchFilter[] = ['name', 'LIKE', "%" . $request->name . "%"];
        }

        if ($request->vendor != '' && $request->vendor > 0) {
            $searchFilter[] = ['vendor_id', $request->vendor];
        }

        if ($request->department != '' && $request->department > 0) {
            $searchFilter[] = ['department_id', $request->department];
        }

        $results = $this->__settingService->filterDynamicForms($searchFilter);
//        dd($results->toSql());
        return DataTables::eloquent($results)
            ->editColumn('navigation_name', function ($query) {
                return !is_null($query->navigation) ? $query->navigation->name : '';

            })->editColumn('created_at', function ($query) {
                return !is_null($query->created_at) ? date('Y-m-d', strtotime($query->created_at)) : '--';

            })->addColumn('creator_name', function ($query) {
                return $query->creator ? optional($query->creator)->name : '';

            })->addColumn('status', function ($query) {
                return 'active';

            })
            ->addColumn('color_box', function ($query) use ($request) {
                return "<div class='text-center' style='width:40px; height:40px; border-radius: 50%;background-color:" . $query->color_code . "'> </div>";
            })
            ->addColumn('action', function ($query) use ($request) {
                $view_url = URL::to('DynamicForms/' . base64url_encode($query->id) . '/view');
                $view_button = "<a href='$view_url'>
                            <span class='edit-icon text-theme-dark'>
                                <i class='fa fa-eye'></i>
                            </span>
                        </a>";

                $listing = "<a href='" . route('dynamic_forms.listing', $query->id) . "'>
                            <span class='text-theme-dark'>
                                <i class='bx bx-list-ol'></i>
                            </span>
                        </a>";

                $edit_button = '';
//                if (hasPermission('edit_report')) {
                $edit_link = route('dynamic_forms.edit', base64_encode($query->id));
                $edit_button = "<a href='$edit_link'><i class='bx bx-edit fa fa-eye'></i></a>";
//                }

                $delete_button = '';
                if (hasPermission('delete_report')) {
                    $delete_link = URL::to('DynamicForms/delete/') . '/' . base64url_encode($query->id);
                    $delete_button = "<a data-original-title='Delete' class='fa fa-trash text-theme-dark'
                    onclick='verifyCheck(\"$delete_link\")'
                    href='javascript:void(0);'></a>";
                }

                return "$edit_button $delete_button $view_button $listing";

            })
            ->rawColumns(['navigation_name', 'created_at', 'creator_name', 'status', 'action'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['navigations'] = $this->__settingService->getParentNavs();
        return view('settings::dynamic_forms.create_modal', $this->data);
    }

    public function validate(Request $request)
    {
        $paramsCheckArray = [
            'schema_name' => $request->post('schema_name'),
        ];
        if (!$this->__settingService->recordExists($paramsCheckArray)) {
            return response()->json(['success' => true, 'message' => 'This request data is valid'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Already Exists!'], 422);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->data = $request->all();
//        dd($this->data,$request->only(['navigation_id','node_name','node_sort_order','schema_name','allowed_operations']));
        $form = $this->__settingService->create($this->data);
        $routeFilePath = module_path('Settings') . '/Routes/web.php';
        if ($this->addRouteEntry($routeFilePath,$form->schema_name)) {
            return response()->json(['success' => true, 'message' => 'Form & Route Created Successfully!'], 200);
        }

        return response()->json(['success' => true, 'message' => 'Form Created Successfully!'], 200);
//        return redirect()->route('dynamic_forms');
    }

    function addRouteEntry($path, $table)
    {
        $stub = file_get_contents(module_path('Settings').'/stubs/route.entry.stub');
        $target = file_get_contents($path);
        if (strstr($target,"name('$table')")) {
            return false;
        }
        // Replace placeholders in the migration stub
        $stub = str_replace('{{ table }}', $table, $stub);
        $stub = str_replace('#ROUTE_PLACE_FOR_NEW_ENRTY#', $stub, $target);

        file_put_contents($path, $stub);
        return true;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->data['row'] = $this->__settingService->get($id);
        $this->data['navigations'] = $this->__settingService->getParentNavs();
        return view('settings::dynamic_forms.view', $this->data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data['row'] = $form = $this->__settingService->get($id);
        $this->data['dropdowns'] = $form = $this->__settingService->getDropdownOptions();
//        $routeFilePath = module_path('Settings') . '/Routes/web.php';
//        $this->addRouteEntry($routeFilePath,$form->schema_name);

        $this->data['navigations'] = $this->__settingService->getParentNavs();
        return view('settings::dynamic_forms.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param BudgetTypeRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $this->data = $request->all(); #dd($this->data);
        $this->__settingService->update($this->data, $id);
        return redirect()->route('dynamic_forms')->with(['success' => 'Successfully updated!']);
        //
    }

    public function makeMigrationCommand(Request $request, $id)
    {
        try {
            $row = $this->__settingService->get($id);
            $formEntries = $row->formEntries;
            $fieldsString = $formEntries->map(function ($record) {
                $field_type = ($record->field_type == 'varchar') ? 'string' : $record->field_type;
                return '"' . $record->field_name . '":"' . $field_type . '"'; //.'-'.$record->field_length.'"';
            })->implode(',');

            $command = 'make:dynamic-migration ' . $row->schema_name . ' --fields=\'{' . $fieldsString . '}\'';
            Artisan::call($command);
            echo Artisan::output();
            $migrate = Artisan::call('migrate');
            $row->update(['migrate' => 1]);
            echo 'migrated: ' . $migrate;
            if ($migrate) {
                echo PHP_EOL . 'Successfully created table: ' . $row->schema_name;
//            $row->update(['migrate' => 1]);
            }
        } catch (\Exception $exception) {
            echo "<pre>Exception: " . $exception->getMessage() . "</pre>";
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model = $this->__settingService->get($id);
        $model->delete();
        return redirect()->route('budget_types.index');
    }

    public function listing($id)
    {
        $this->data['routePrefix'] = 'dynamic_forms.';
        $form = $this->__settingService->get($id);
        $this->data['title'] = $form->node_name . ' Forms';

        $this->data['id'] = $id;
        $this->data['fields'] = $entries = $form->formEntries;
        $this->data['rows'] = $this->__settingService->getFormListingData($form->schema_name,$form->soft_delete)->toArray();
        $select = $entries->where('control_type', 'select');

        try {
            if (sizeof($select)) {
                foreach ($select as $row) {
                    $list = \DB::table($row->checklist)->select('id', 'name')->get()->toArray();
                    $listArr = [];
                    foreach ($list as $record) {
                        $listArr[$record->id] = $record->name;
                    }
                    $this->data['select'][$row->checklist] = $listArr;
                }
            }
        } catch (\Exception $exception) {
            \Log::info('Exception: '.$exception);
        }
//        dd($this->data['rows']);
        return view('settings::dynamic_forms.user_views.listing', $this->data);
    }

    function createForm($id)
    {
        $this->data['id'] = $id;
        $this->data['fields'] = $entries = $this->__settingService->getAllFormEntries($id)->whereNotIn('field_name', [
            'created_by','created_at','updated_by','updated_at'
        ]);
        $select = $entries->where('control_type', 'select');
        if (sizeof($select)) {
            foreach ($select as $row) {
                $this->data['select'][$row->checklist] = \DB::table($row->checklist)->select('id', 'name')->get()->toArray();
            }
        }

        return view('settings::dynamic_forms.user_views.create_modal', $this->data);
    }

    public function storeForm(Request $request, $id)
    {
        $this->data = $request->except('_token');
        $this->data['created_by'] = Auth::user()->id;
        $this->data['created_at'] = date('Y-m-d H:i:s');
        $this->__settingService->storeFormData($this->data, $id);
        return response()->json(['success' => true, 'message' => 'Record Created Successfully!'], 200);
    }

    function editForm($id, $recordId)
    {
        $this->data['id'] = $id;
        $this->data['recordId'] = $recordId;
        $form = $this->__settingService->get($id);
        $this->data['form'] = $form;
        $this->data['fields'] = $entries = $this->__settingService->getAllFormEntries($id);
        $this->data['row'] = $this->__settingService->getFormRecord($form->schema_name, $recordId);
        $select = $entries->where('control_type', 'select');
        if (sizeof($select)) {
            foreach ($select as $row) {
                $this->data['select'][$row->checklist] = \DB::table($row->checklist)->select('id', 'name')->get()->toArray();
            }
        }
        return view('settings::dynamic_forms.user_views.edit_modal', $this->data);
    }

    public function updateForm(Request $request, $id)
    {
        $this->data = $request->except('_token');
        $form = $this->__settingService->get($id);
        $formEntries = $form->formEntries;
        if (in_array('updated_by',$formEntries->pluck('field_name')->toArray())) {
            $this->data['updated_by'] = Auth::user()->id;
        }
        $this->data['updated_at'] = date('Y-m-d H:i:s');
        $this->__settingService->updateFormData($this->data, $form);

        return response()->json(['success' => true, 'message' => 'Record updated Successfully!'], 200);
    }

    function deleteFormEntry($id,$recordId)
    {
        $params['id'] = $recordId;
        $params['updated_by'] = Auth::user()->id;
        $params['updated_at'] = date('Y-m-d H:i:s');
        $form = $this->__settingService->deleteFormEntry($params, $id);
        return redirect()->route($form->schema_name,[$form->id])->with(['success' => 'Record deleted Successfully!']);
//        return response()->json(['success' => true, 'message' => 'Record deleted Successfully!'], 200);
    }

    function showForm($id, $recordId)
    {
        $this->data['id'] = $id;
        $form = $this->__settingService->get($id);
        $this->data['form'] = $form;
        $this->data['fields'] = $entries = $this->__settingService->getAllFormEntries($id);
        $this->data['row'] = $this->__settingService->getFormRecord($form->schema_name, $recordId);
        $select = $entries->where('control_type', 'select');
        if (sizeof($select)) {
            foreach ($select as $row) {
                $this->data['select'][$row->checklist] = \DB::table($row->checklist)->select('id', 'name')->get()->toArray();
            }
        }

        return view('settings::dynamic_forms.user_views.view_modal', $this->data);
    }
}
