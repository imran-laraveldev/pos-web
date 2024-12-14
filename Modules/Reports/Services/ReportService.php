<?php


namespace Modules\Reports\Services;


use App\Services\BaseService;
use Modules\Reports\Entities\Inventory;
use Modules\Reports\Entities\Order;
use Modules\Settings\Entities\BudgetType;
use Modules\Settings\Entities\Product;

class ReportService extends BaseService
{
    public function __construct(){}

    public function getAllInventory()
    {
        return Inventory::Paginate(100);
    }

    public function getAllOrders()
    {
        return Order::with('creator')->get();
    }
    public function getOrderById($id)
    {
        return Order::with('order_details')
            ->where('order_id', $id)->first();
    }

    function get($id)
    {
        return Inventory::find($id);
    }

    function getSearchInventory()
    {

    }

    function queryBudgetType($department_id=null)
    {
        $query = Inventory::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterInventory($where=[],$statusOnly=false)
    {
        $query = Inventory::with('department','vendor')->where('department_id', '>','0');
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

    function filterSaleOrders($where=[],$statusOnly=false)
    {
//        $query = Order::with('creator','branch');
        $query = Order::query();
        if ($statusOnly) {
            $query->where($where);
        } else {
            if (isAdmin()) {
                $query->where('case_type', 'reference');
                $query->whereIn('case_appeal', ['session','appeal-1','appeal-2']);
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

    function importInventoryToProducts()
    {
        $query = Inventory::where('department_id', '>','0')->where('inventory_id', '<', '460')->orderby('inventory_id')->get();
        $products = [];
        foreach ($query as $row) {
            $title = in_array($row->department_id, [2,7]) ? $row->name : trim(str_replace($row->code, '',$row->name));
            $products[] = [
                'title' => $title,
                'code' => $row->code,
                'color_code' => $row->description,
                'department_id' => $row->department_id,
                'vendor_id' => $row->vendor_id,
                'sale_price' => $row->sale_price,
                'cost_price' => $row->buy_price,
            ];
        }
        Product::insert($products);
    }
}
