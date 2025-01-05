<?php

namespace Modules\Schools\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Schools\Services\StudentService;

class MarkSheetController extends Controller
{
    protected $__studentService;
    protected $data;

    public function __construct(StudentService $studentService)
    {
        $this->middleware('auth');
        $this->__studentService = $studentService;
        $this->data['routePrefix'] = 'schools.marksheets.';
        $this->data['module'] = __('label.marksheets');
        $this->data['title'] = __('label.marksheets');
        $this->data['divisions'] = [['id' => 1, 'name' => 'Boys'],['id' => 2, 'name' => 'Girls']];
        $this->data['courses'] = $this->__studentService->getCourseList();
        $this->data['batch_id'] = 8;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->data['title'] = 'Student';
        $this->data['rows'] = null;
        $this->data['student_type'] = 0;
        $this->data['batches'] = $this->__studentService->getBatchList();
        $this->data['course_list'] = $this->__studentService->getCourseList();
        $this->data['subject_list'] = $this->__studentService->getSubjectsList();
        $this->data['term'] = $term = !empty($_POST['term']) ? $_POST['term'] : date('m', strtotime("-1 month"));
        $this->data['model'] = 'marksheets';
        return view('schools::marksheets.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('schools::create');
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
        return view('schools::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('schools::edit');
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
