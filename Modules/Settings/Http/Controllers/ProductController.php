<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Modules\Settings\Http\Requests\BudgetTypeRequest;
use Modules\Settings\Services\ProductService;
use Yajra\DataTables\Facades\DataTables;
use function Ramsey\Uuid\Codec\decode;
use function Ramsey\Uuid\Codec\encode;

class ProductController extends Controller
{
    protected $__settingService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth');
        $this->__settingService = $productService;
        $this->data['routePrefix'] = 'products.';
        $this->data['title'] = __('label.products');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->data['title'] = 'Product';
        $this->data['rows'] = null; #$this->__settingService->getAll();
        return view('settings::products.index',$this->data);
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

        $results = $this->__settingService->filterProducts($searchFilter);
//        dd($results->toSql());
        return DataTables::eloquent($results)
            ->editColumn('inventory_name', function ($query) {
                return !empty($query->title) ? $query->title : '';

            })
            ->addColumn('department_name', function ($query) {
                return optional($query->department)->name ?? '-';

            })
            ->addColumn('vendor_name', function ($query) {
                return optional($query->vendor)->company_name ?? '-';

            })
            ->addColumn('color_box', function ($query) use ($request) {
                return "<div class='text-center' style='width:40px; height:40px; border-radius: 50%;background-color:". $query->color_code . "'> </div>";
            })
            ->addColumn('action', function ($query) use ($request) {
                $view_url = URL::to('products/' . base64url_encode($query->id) . '/view');
                $view_button = "<a href='$view_url'>
                            <span class='edit-icon text-theme-dark'>
                                <i class='fa fa-eye'></i>
                            </span>
                        </a>";

                $edit_button = '';
//                if (hasPermission('edit_report')) {
                    $edit_link = route('products.edit', base64_encode($query->id));
                    $edit_button = "<a href='$edit_link'><i class='bx bx-edit fa fa-eye'></i></a>";
//                }

                $delete_button = '';
                if (hasPermission('delete_report')) {
                    $delete_link = URL::to('products/delete/') . '/' . base64url_encode($query->id);
                    $delete_button = "<a data-original-title='Delete' class='fa fa-trash text-theme-dark'
                    onclick='verifyCheck(\"$delete_link\")'
                    href='javascript:void(0);'></a>";
                }

                return "$edit_button $delete_button $view_button";

            })
            ->rawColumns(['inventory_name','color_box','department_name','vendor_name','action'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['departments'] = $this->__settingService->getDepartmentAll();
        return view('settings::products.create_modal',$this->data);
    }

    public function validate(Request $request)
    {
        $paramsCheckArray = [
            'financial_year_idfk' => $request->post('financial_year_idfk'),
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
    public function store(BudgetTypeRequest $request)
    {
        $this->data = $request->all();
        $this->__settingService->create($this->data);
        return redirect()->route('products.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $this->data['row'] = $this->__settingService->get($id);
        $this->data['departments'] = $this->__settingService->getDepartmentAll();
        return view('settings::products.view',$this->data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data['row'] = $this->__settingService->get($id);
        $this->data['departments'] = $this->__settingService->getDepartmentAll();
        return view('settings::products.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param BudgetTypeRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(BudgetTypeRequest $request,$id)
    {
        $this->data = $request->all(); #dd($this->data);
        $this->__settingService->update($this->data,$id);
        return redirect()->route('products.index');
        //
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
}
