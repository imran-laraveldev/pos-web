<?php

namespace Modules\Schools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolStudentSubject extends Model
{
    use HasFactory;

    protected $connection = 'mysql-fast';
    protected $table = 'student_subject_monthly';
    protected $primaryKey = 'subject_id';
    protected $guarded = ['subject_id'];
    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Schools\Database\factories\SchoolStudentSubjectFactory::new();
    }
}
