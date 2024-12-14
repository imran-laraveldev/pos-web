<?php


namespace Modules\Settings\Services;


use App\Services\BaseService;
use Modules\Settings\Entities\BudgetType;

class BudgetTypeService extends BaseService
{
    public function __construct(){}

    public function getAll()
    {
        return BudgetType::with('department')->get();
    }

    function get($id)
    {
        return BudgetType::find($id);
    }

    function queryBudgetType($department_id=null)
    {
        $query = BudgetType::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterBudgetType($where=[],$statusOnly=false)
    {
        $query = BudgetType::with('department');
        if ($statusOnly) {
            $query->where($where);
        } else {
            if (isAdmin()) {
                $caseAppeal = ['session','appeal-1','appeal-2'];
                if (sizeof($where)) {
                    $caseAppeal = ['session','appeal-1'];
                    if ($where[0][2] == 'all') $where = [];
                }
                $query->where('case_type', 'reference');
                $query->whereIn('case_appeal', $caseAppeal);
            } elseif(isManager()) {
                $query->where(function ($q){
                    $q->where('case_type', 'reference');
                    $q->whereIn('case_appeal', ['appeal-2','appeal-3']);
                });
                $query->orWhere('case_type', 'writ');

            }
            $query->where($where);
        }
        return $query;
    }

    function create($params)
    {
        return BudgetType::create([
            'title' => $params['name'],
            'sector' => $params['sector'],
            'sub_sector' => $params['sub_sector'],
            'department_idfk' => $params['department_idfk'],
        ]);
    }

    function update($params,$id)
    {
        $model = $this->get($id);
        $model->update([
            'title' => $params['name'],
            'sector' => $params['sector'],
            'sub_sector' => $params['sub_sector'],
            'department_idfk' => $params['department_idfk'],
        ]);
        return $model;
    }
}
