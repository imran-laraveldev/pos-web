<?php

namespace Modules\Schools\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentPayment extends Model
{
    use HasFactory,SoftDeletes;
    protected $connection = 'mysql-fast';
    protected $fillable = ['subject_id', 'month', 'due_amount','due_date','payment_amount','payment_date','payment_mode',
        'receipt_number','fee_desc', 'fee_month', 'division_id','batch_id','user_id'];
    const CREATED_AT = 'created_date';

    protected static function newFactory()
    {
        return \Modules\Schools\Database\factories\StudentPaymentFactory::new();
    }
}
