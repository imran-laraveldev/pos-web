<?php

namespace Modules\Schools\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Modules\Schools\Http\Requests\StudentRequest;
use Modules\Schools\Services\StudentService;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    protected $__studentService;
    protected $data;

    public function __construct(StudentService $studentService)
    {
        $this->middleware('auth');
        $this->__studentService = $studentService;
        $this->data['routePrefix'] = 'schools.students.';
        $this->data['module'] = __('label.schools');
        $this->data['title'] = __('label.students');
        $this->data['batch_id'] = 8;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->data['title'] = 'Student';
        $this->data['rows'] = null; #$this->__studentService->getAll();
        $this->data['student_type'] = 1;
        return view('schools::students.index',$this->data);
    }

    public function testStudents()
    {
        $this->data['title'] = 'Test Student';
        $this->data['rows'] = null;
        $this->data['student_type'] = 9;
        return view('schools::students.index',$this->data);
    }

    public function getDatatableList(Request $request)
    {
        $searchFilter = [['cdel', $request->student_type],['batch_id', $request->batch_id]];
        if ($request->student_name != '') {
            $searchFilter[] = ['student_name', 'LIKE', "%" . $request->student_name . "%"];
        }

        if ($request->father_name != '') {
            $searchFilter[] = ['father_name', 'LIKE', $request->father_name . "%"];
        }

        if ($request->admission_number != '') {
            $searchFilter[] = ['admission_number', 'LIKE', $request->admission_number . "%"];
        }

        if ($request->contact != '') {
            $searchFilter[] = ['cell_phone_father', 'LIKE', $request->contact . "%"];
        }

        $results = $this->__studentService->filterProducts($searchFilter);
//        dd($results->toSql());
        return DataTables::eloquent($results)
            ->editColumn('class', function ($query) {
                return !empty($query->class) ? $query->class : '';
            })
            ->addColumn('department_name', function ($query) {
                return optional($query->department)->name ?? '-';
            })
            ->addColumn('color_box', function ($query) use ($request) {
                return "<div class='text-center' style='width:40px; height:40px; border-radius: 50%;background-color:". $query->color_code . "'> </div>";
            })
            ->addColumn('action', function ($query) use ($request) {
                $view_url = URL::to('schools/students/' . base64_encode($query->student_id) . '/view');
                $view_button = "<a href='$view_url'>
                            <span class='edit-icon text-theme-dark'>
                                <i class='fa fa-eye'></i>View
                            </span>
                        </a>";

                $edit_button = '';
//                if (hasPermission('edit_report')) {
                $edit_link = route('schools.students.edit', base64_encode($query->student_id));
                $edit_button = "<a href='$edit_link'><i class='bx bx-edit fa fa-eye'></i></a>";
//                }

                $delete_button = '';
                if (hasPermission('delete_report')) {
                    $delete_link = URL::to('students/delete/') . '/' . base64url_encode($query->student_id);
                    $delete_button = "<a data-original-title='Delete' class='fa fa-trash text-theme-dark'
                    onclick='verifyCheck(\"$delete_link\")'
                    href='javascript:void(0);'></a>";
                }

                return "$edit_button $delete_button $view_button";
            })
            ->rawColumns(['inventory_name','color_box','department_name','vendor_name','action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->data['departments'] = $this->__studentService->getDepartmentAll();
        return view('schools::students.create_modal',$this->data);
    }

    public function validate(Request $request)
    {
        $paramsCheckArray = [
            'financial_year_idfk' => $request->post('financial_year_idfk'),
        ];
        if (!$this->__studentService->recordExists($paramsCheckArray)) {
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
        $this->__studentService->create($this->data);
        return redirect()->route('students.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $this->data['row'] = $student = $this->__studentService->get($id);
        $this->data['genders'] = [['id' => 'M', 'name' => "Boy"], ['id' => 'F', 'name' => "Girl"]];
        $this->data['batches'] = $this->__studentService->getBatchList();
        $this->data['subjects'] = $this->__studentService->getSubjectsList();
        $this->data['selectedSubject'] = $this->__studentService->getAssignedSubjects($student)
            ->pluck('subject_id')->toArray();

        return view('schools::students.view',$this->data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data['row'] = $student = $this->__studentService->get($id);
        $this->data['genders'] = [['id' => 'M', 'name' => "Boy"], ['id' => 'F', 'name' => "Girl"]];
        $this->data['batches'] = $this->__studentService->getBatchList();
        $this->data['subjects'] = $this->__studentService->getSubjectsList();
        $this->data['selectedSubject'] = $this->__studentService->getAssignedSubjects($student)
            ->pluck('subject_id')->toArray();

        return view('schools::students.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param StudentRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(StudentRequest $request,$id)
    {
        $this->data = $request->all();
        $this->__studentService->update($this->data,$id);
        return redirect()->route($this->data['redirect_url']);
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $model = $this->__studentService->get($id);
        $model->delete();
        return redirect()->route('budget_types.index');
    }


    public function listing()
    {
        return view('schools::index');
    }
}
