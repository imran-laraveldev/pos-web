<?php

namespace Modules\Schools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolStudent extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $guarded = ['student_id'];
    protected $connection = 'mysql-fast';
    public $timestamps = false;

    protected static function newFactory()
    {
        return \Modules\Schools\Database\factories\SchoolStudentFactory::new();
    }

    function course()
    {
        return $this->belongsTo(SchoolCourse::class,'course_id', 'course_id');
    }

    function getClassAttribute()
    {
        return optional($this->course)->course_name . ' ' .$this->section;
    }

    function subjects($batch=false)
    {
        $month = date('m');
        $query = $this->hasManyThrough(SchoolSubject::class, StudentSubjectMonthly::class, 'student_id',
            'subject_id','student_id','subject_id')->where('month', $month);
        if ($batch) {
            $query->where('batch_id', $batch);
        }
        return $query;
    }
}
