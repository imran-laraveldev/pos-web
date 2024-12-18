<?php

namespace Modules\Schools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolCourseSubject extends Model
{
    use HasFactory;

    protected $connection = 'mysql-fast';
    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    protected $guarded = ['subject_id'];

    protected static function newFactory()
    {
        return \Modules\Schools\Database\factories\SchoolCourseSubjectFactory::new();
    }
}
