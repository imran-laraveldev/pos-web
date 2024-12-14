<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Reports\Services\ReportService;

class DashboardController extends Controller
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
        $data['title'] = 'Reporting Dashboard';
        $data['formsStats'] = $this->__reportService->getDashboardStats();
        $data['post'] = [
            'name' => '',
            'category_idfk' => '1',
            'code' => ''];
//        $this->__reportService->importInventoryToProducts();
        $data['rows'] = null; #$this->__reportService->getAllInventory();
        return view('reports::dashboard.index',$data);
    }
}
