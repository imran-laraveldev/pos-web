<?php


namespace Modules\Schools\Services;


use Modules\Schools\Entities\SchoolBatch;
use Modules\Schools\Entities\SchoolCourse;
use Modules\Schools\Entities\SchoolStudent;
use Modules\Schools\Entities\SchoolSubject;
use Modules\Schools\Entities\StudentSubjectMonthly;
use function Nette\Utils\size;

class SchoolService
{

    function getBatchList(){
        return SchoolBatch::select('batch_id as id', 'batch_name as name')->get();
    }

    function getCourseList(){
        return SchoolCourse::select('course_id as id', 'course_name as name')->where('is_active','Y')->get();
    }

    function getSubjectsList(){
        return SchoolSubject::select('subject_id as id', 'subject_name as name')->where('is_active', 'Y')->get();
    }

    function getAdmissionNumber($batch=8)
    {
        $students = SchoolStudent::select(\DB::Raw("MAX(student_id) as id"),\DB::Raw("MAX(admission_number) as num"), 'gender')
            ->where('batch_id', $batch)
            ->groupBy('gender')->get();
        $resultArr = [];
        foreach($students as $student) {
            $resultArr[$student->gender] = $this->generateAdmissionNumber($student->num);
        }
        return $resultArr;
    }

    function generateAdmissionNumber($number)
    {
        $number = explode('-', $number);
        if (sizeof($number) == 3) {
            $count = $number[2] + 1;
            $number[2] = str_pad($count, 4, '0', STR_PAD_LEFT);
        }
        return implode('-', $number);
    }

    function getAssignedSubjects($student)
    {
        return StudentSubjectMonthly::select('subject_id','obtained_marks')->where([
            ['student_id', '=', $student->student_id],
            ['batch_id', '=', $student->batch_id],
            ['month', '=', $student->month],
            ])->get(); //->getBindings();
    }
}
