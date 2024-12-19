<?php


namespace Modules\Schools\Services;


use Modules\Schools\Entities\SchoolBatch;
use Modules\Schools\Entities\SchoolSubject;
use Modules\Schools\Entities\StudentSubjectMonthly;

class SchoolService
{

    function getBatchList(){
        return SchoolBatch::select('batch_id as id', 'batch_name as name')->get();
    }

    function getSubjectsList(){
        return SchoolSubject::select('subject_id as id', 'subject_name as name')->where('is_active', 'Y')->get();
    }

    function getAssignedSubjects($student)
    {
        return StudentSubjectMonthly::select('subject_id','obtained_marks')->where([
            ['student_id', '=', $student->student_id],
            ['batch_id', '=', $student->batch_id],
            ['month', '=', $student->month],
            ])->get();
    }
}
