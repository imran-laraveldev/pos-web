<?php


namespace Modules\Schools\Services;


use Modules\Schools\Entities\SchoolStudent;

class StudentService extends SchoolService
{
    public function __construct(){}

    public function getAll()
    {
        return SchoolStudent::with('course')->get();
    }

    function get($id)
    {
        return SchoolStudent::find($id);
    }

    function queryProduct($department_id=null)
    {
        $query = SchoolStudent::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterProducts($where=[],$statusOnly=false)
    {
        $query = SchoolStudent::with('course');
        if ($statusOnly) {
            $query->where($where);
        } else {
            $query->where($where);
        }
        return $query;
    }

    function recordExists($paramsArray)
    {
        return SchoolStudent::where($paramsArray)->exists();
    }

    function create($params)
    {
        return SchoolStudent::create([
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
