<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Modules\Reports\Services\ReportService;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{
    protected $__reportService;

    function __construct(ReportService $reportService)
    {
        $this->__reportService = $reportService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['title'] = 'Inventory Report';
        $data['categories'] = $this->__reportService->getCategories();
        $data['post'] = [
            'name' => '',
            'category_idfk' => '1',
            'code' => ''];
//        $this->__reportService->importInventoryToProducts();
        $data['rows'] = null; #$this->__reportService->getAllInventory();
        return view('reports::index',$data);
    }

    public function getReportDatatable(Request $request)
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

        $results = $this->__reportService->filterInventory($searchFilter);
//        dd($results->toSql());
        return DataTables::eloquent($results)
            ->editColumn('inventory_name', function ($query) {
                return !empty($query->name) ? $query->name : $query->name_ar;

            })
            ->addColumn('department_name', function ($query) {
                return optional($query->department)->name ?? '-';

            })
            ->addColumn('vendor_name', function ($query) {
                return optional($query->vendor)->company_name ?? '-';

            })
            ->addColumn('color_box', function ($query) use ($request) {
                return "<div class='text-center' style='width:40px; height:40px; border-radius: 50%;background-color:". $query->description . "'> </div>";
            })
            ->addColumn('action', function ($query) use ($request) {
                $view_url = URL::to('reports/' . base64url_encode($query->inventory_id) . '/view');
                $view_button = "<a href='$view_url'>
                            <span class='edit-icon text-theme-dark'>
                                <i class='fa fa-eye'></i>
                            </span>
                        </a>";

                $edit_button = '';
                if (hasPermission('edit_report')) {
                    $edit_link = URL::to('reports/' . base64url_encode($query->inventory_id) . '/edit');
                    $edit_button = "<a href='$edit_link'>
                    <span class='edit-icon text-theme-dark'>
                        <i class='fa fa-pencil'></i>
                    </span>
                </a>";
                }

                $delete_button = '';
                if (hasPermission('delete_report')) {
                    $delete_link = URL::to('reports/delete/') . '/' . base64url_encode($query->inventory_id);
                    $delete_button = "<a data-original-title='Delete' class='fa fa-trash text-theme-dark'
                    onclick='verifyCheck(\"$delete_link\")'
                    href='javascript:void(0);'></a>";
                }

                return "$edit_button $delete_button $view_button";

            })
            ->rawColumns(['inventory_name','color_box','department_name','vendor_name','action'])->make(true);
    }

    public function sales()
    {
        $data['title'] = 'Sale Report';
        $data['users'] = [];
        $data['post'] = [
            'user_id' => '',
            'reference_number' => '',
            'search_date' => date('Y-m-d')];
        $object = (object) $data['post'];
        $whereClause = $this->setFilters($object);
//        dd($whereClause);
//        $data['rows'] = $this->__reportService->getAllOrders();
        $data['rows'] = $this->__reportService->filterSaleOrders($whereClause)->get();
        return view('reports::sales',$data);
    }

    function setFilters($request)
    {
        $searchFilter = [];
        if ($request->user_id != '') {
            $searchFilter[] = ['user_id', $request->user_id];
        }

        if ($request->search_date != '') {
            $searchFilter[] = ['created_date', $request->search_date];
        }

        if ($request->reference_number != '') {
            $searchFilter[] = ['reference_number', 'LIKE', "%" . $request->reference_number . "%"];
        }

        return $searchFilter;
    }

    public function getSaleReportDatatable(Request $request)
    {
        $searchFilter = [];
        if ($request->reference_number != '') {
            $searchFilter[] = ['reference_number', 'LIKE', "%" . $request->reference_number . "%"];
        }

        $results = $this->__reportService->filterSaleOrders($searchFilter);
//        dd($results->toSql());
//        dd($results->get());
        return DataTables::eloquent($results)
            ->addColumn('login_user', function ($query) {
//                return optional($query->creator)->name ?? '--';
                return 'admin';
            })
            ->addColumn('branch_name', function ($query) {
//                return optional($query->branch)->name ?? '-';
                return 'riyadh';
            })
            ->addColumn('action', function ($query) use ($request) {
                $view_url = URL::to('reports/' . base64url_encode($query->order_id) . '/view');
                $view_button = "<a href='$view_url'>
                            <span class='edit-icon text-theme-dark'>
                                <i class='fa fa-eye'></i>
                            </span>
                        </a>";

                $edit_button = '';
                if (hasPermission('edit_report')) {
                    $edit_link = URL::to('reports/' . base64url_encode($query->order_id) . '/edit');
                    $edit_button = "<a href='$edit_link'>
                    <span class='edit-icon text-theme-dark'>
                        <i class='fa fa-pencil'></i>
                    </span>
                </a>";
                }

                $delete_button = '';
                if (hasPermission('delete_report')) {
                    $delete_link = URL::to('reports/delete/') . '/' . base64url_encode($query->order_id);
                    $delete_button = "<a data-original-title='Delete' class='fa fa-trash text-theme-dark'
                    onclick='verifyCheck(\"$delete_link\")'
                    href='javascript:void(0);'></a>";
                }

                return "$edit_button $delete_button $view_button";

            })
            ->rawColumns(['branch_name','login_user','action'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('reports::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['title'] = 'Order View';
        $data['item'] = $this->__reportService->getOrderById($id);
        return view('reports::sales.order',$data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('reports::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
