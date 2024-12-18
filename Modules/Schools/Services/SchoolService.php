<?php


namespace Modules\Schools\Services;


use Modules\Schools\Entities\SchoolCourseSubject;

class SchoolService
{

    function getSubjectsList(){
        return SchoolCourseSubject::select('subject_id as id', 'subject_name as name')->where('is_active', 'Y')->get();
    }
}
