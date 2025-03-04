<?php


namespace Modules\Settings\Services;


use App\Services\BaseService;
use Modules\Settings\Entities\Visit;
use Modules\Settings\Entities\VisitType;

class VisitService extends BaseService
{
    public function __construct(){}

    public function getAll()
    {
        return Visit::with('department')->get();
    }

    function get($id)
    {
        return Visit::find($id);
    }

    function getAllVisitType()
    {
        return VisitType::where('branch_idfk', '1')->get();
    }

    function queryProduct($department_id=null)
    {
        $query = Visit::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterProducts($where=[],$statusOnly=false)
    {
        $query = Visit::with('department');
        if ($statusOnly) {
            $query->where($where);
        } else {
            $query->where($where);
        }
        return $query;
    }

    function recordExists($paramsArray)
    {
        return Visit::where($paramsArray)->exists();
    }

    function create($params)
    {
        return Visit::create([
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
