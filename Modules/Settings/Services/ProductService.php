<?php


namespace Modules\Settings\Services;


use App\Services\BaseService;
use Modules\Settings\Entities\Product;

class ProductService extends BaseService
{
    public function __construct(){}

    public function getAll()
    {
        return Product::with('department')->get();
    }

    function get($id)
    {
        return Product::find($id);
    }

    function queryProduct($department_id=null)
    {
        $query = Product::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterProducts($where=[],$statusOnly=false)
    {
        $query = Product::with('department');
        if ($statusOnly) {
            $query->where($where);
        } else {
            $query->where($where);
        }
        return $query;
    }

    function recordExists($paramsArray)
    {
        return Product::where($paramsArray)->exists();
    }

    function create($params)
    {
        return Product::create([
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
