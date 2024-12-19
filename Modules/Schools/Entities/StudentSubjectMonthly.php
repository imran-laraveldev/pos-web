<?php

namespace Modules\Schools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentSubjectMonthly extends Model
{
    use HasFactory;
    protected $table = 'student_subject_monthly'; // Define the table name
    protected $connection = 'mysql-fast'; // Use the correct database connection
    public $timestamps = false; // If the table doesn't have created_at/updated_at
    protected $fillable = ['student_id','subject_id'];
    protected static function newFactory()
    {
        return \Modules\Schools\Database\factories\StudentSubjectMonthlyFactory::new();
    }
}
