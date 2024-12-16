<?php

namespace Modules\Schools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolCourse extends Model
{
    use HasFactory;
    protected $connection = 'mysql-fast';
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $guarded = ['course_id'];

    protected static function newFactory()
    {
        return \Modules\Schools\Database\factories\SchoolCourseFactory::new();
    }
}
