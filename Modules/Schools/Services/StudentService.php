<?php


namespace Modules\Schools\Services;


use Illuminate\Support\Facades\Auth;
use Modules\Schools\Entities\SchoolStudent;
use Modules\Schools\Entities\SchoolSubject;
use Modules\Schools\Entities\StudentPayment;
use Modules\Schools\Entities\StudentStudentPayment;
use Modules\Schools\Entities\StudentSubjectMonthly;

class StudentService extends SchoolService
{
    public function __construct(){}

    public function getAll()
    {
        return SchoolStudent::with('course')->get();
    }

    function get($id)
    {
        return SchoolStudent::where('student_id', $id)->first(); //find($id);
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
        $month = date('m');
        $div_id = $params['gender'] == 'F' ? 2 : 1;
        $admissionNumber = $this->generateAdmissionNumber($params['admission_number']);

        $student = SchoolStudent::create([
            'student_name' => $params['student_name'],
            'father_name' => $params['father_name'],
            'date_of_birth' => $params['date_of_birth'],
            'cell_phone_father' => $params['cell_phone_father'],
            'address_line1' => $params['address_line1'],
            'gender' => $params['gender'],
            'course_id' => $params['course_id'],
            'section' => $params['section'],
            'batch_id' => $params['batch_id'],
            'cdel' => $params['cdel'],
            'division_id' => $div_id,
            'month' => $month,
            'admission_number' => $admissionNumber,
            'admission_date' => $params['admission_date'] ?? date('Y-m-d')
        ]);

        $student_id = $student->student_id;
        $user_id = Auth::id();
        $course_id = $params['course_id'];
        $batch_id = $params['batch_id'];

        $due_date = date('Y-m-01');
        $subject_list = $_POST['availableSubjects'];
        $record = array('student_id' => $student_id, 'batch_id' => $batch_id, 'month' => $month);
        $record1 = array('student_id' => $student_id, 'due_date' => $due_date, 'batch_id' => $batch_id, 'division_id' => $div_id, 'fee_desc' => 'Tuition Fee', 'user_id' => $user_id);

        for ($i = 0; $i < sizeof($subject_list); $i++) {
            $subject_id = $subject_list[$i];
            $subject_fee = $this->getSubjectFee($course_id, $subject_id, $student->cdel);
            $sub = ['subject_id' => $subject_id];
            $receipt[] = array_merge($record, $sub);
            $student_payments[] = array_merge($record1, ['subject_id' => $subject_id, 'month' => $month, 'due_amount' => $subject_fee]);
        }

        StudentSubjectMonthly::insert($receipt);
        StudentPayment::insert($student_payments);
    }

    function getSubjectFee($course_id,$subject_id,$type)
    {
        $feeType = $type == 9 ? 'test_fee_' : 'tuition_fee_';
        $feeColumn = ($course_id < 11) ? $feeType . 'matric' : $feeType . 'inter';
        $subject = SchoolSubject::where([
            ['subject_id', '=', $subject_id],
            ['is_active', '=', 'Y'],
        ])->first();

        return $subject->{$feeColumn} ?? 0;
    }

    function update($params,$id)
    {
        $model = $this->get($id);
        $month = date('m');
        $model->update([
            'student_name' => $params['student_name'],
            'father_name' => $params['father_name'],
            'date_of_birth' => $params['date_of_birth'],
            'cell_phone_father' => $params['cell_phone_father'],
            'address_line1' => $params['address_line1'],
            'gender' => $params['gender'],
            'month' => $month,
        ]);

        $student_id = $model->student_id;
        $user_id = Auth::id();
        $course_id = $params['course_id'];
        $batch_id = $params['batch_id'];
        $div_id = $params['gender'] == 'F' ? 2 : 1;

        $month = date('m');
        $due_date = date('Y-m-01');
        $subject_list = $_POST['availableSubjects'];

        $record = array('student_id' => $student_id, 'batch_id' => $batch_id, 'month' => $month);
        $record1 = array('student_id' => $student_id, 'due_date' => $due_date, 'batch_id' => $batch_id, 'division_id' => $div_id, 'fee_desc' => 'Tuition Fee', 'user_id' => $user_id);

        $studentSubjectMonthly = StudentSubjectMonthly::where($record)->get()->pluck('subject_id')->toArray();
//        StudentPayment::where($record)->update(['mark_delete' => '1', 'updated_by' => $user_id, 'updated_at' => 'NOW()']);

        for ($i = 0; $i < sizeof($subject_list); $i++) {
            $subject_id = $subject_list[$i];
            if (in_array($student_id, $studentSubjectMonthly)) continue;

            $subject_fee = $this->getSubjectFee($course_id, $subject_id, $model->cdel);
            $sub = ['subject_id' => $subject_id];
            $receipt[] = array_merge($record, $sub);
            $student_payments[] = array_merge($record1, ['subject_id' => $subject_id, 'month' => $month, 'due_amount' => $subject_fee]);
        }

        StudentSubjectMonthly::insert($receipt);
        StudentPayment::insert($student_payments);

        return $model;
    }
}
