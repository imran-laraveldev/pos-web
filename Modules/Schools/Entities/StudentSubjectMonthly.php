<?php

namespace Modules\Schools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSubjectMonthly extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'student_subject_monthly'; // Define the table name
    protected $connection = 'mysql-fast'; // Use the correct database connection
//    public $timestamps = false; // If the table doesn't have created_at/updated_at
    protected $fillable = ['student_id','subject_id','batch_id','month','obtained_marks'];

    protected static function newFactory()
    {
        return \Modules\Schools\Database\factories\StudentSubjectMonthlyFactory::new();
    }

    function subject()
    {
        return $this->belongsTo(SchoolSubject::class, 'subject_id','subject_id');
    }
}
