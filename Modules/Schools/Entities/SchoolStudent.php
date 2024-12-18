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
}
