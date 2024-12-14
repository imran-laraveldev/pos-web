<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Requests\BudgetTypeRequest;
use Modules\Settings\Services\BudgetTypeService;

class BudgetTypeController extends Controller
{
    protected $__settingService;

    public function __construct(BudgetTypeService $budgetTypeService)
    {
        $this->middleware('auth');
        $this->__settingService = $budgetTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['title'] = 'Budget Type';
        $data['rows'] = $this->__settingService->getAll();
        return view('settings::budget_types.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['departments'] = $this->__settingService->getDepartmentAll();
        return view('settings::budget_types.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BudgetTypeRequest $request)
    {
        $data = $request->all();
        $this->__settingService->create($data);
        return redirect()->route('budget_types.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data['row'] = $this->__settingService->get($id);
        $data['departments'] = $this->__settingService->getDepartmentAll();
        return view('settings::budget_types.view',$data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $data['row'] = $this->__settingService->get($id);
        $data['departments'] = $this->__settingService->getDepartmentAll();
        return view('settings::budget_types.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param BudgetTypeRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(BudgetTypeRequest $request,$id)
    {
        $data = $request->all(); #dd($data);
        $this->__settingService->update($data,$id);
        return redirect()->route('budget_types.index');
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
