<?php

namespace Modules\Reports\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $connection = 'mysql-pos';
    protected $table = 'order';

    function creator()
    {
        return $this->hasOne(PosUser::class, 'user_id', 'user_id');
    }
//
//    function branch()
//    {
//        return $this->belongsTo(PosBranch::class, 'branch_id', 'branch_id');
//    }

    function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'receipt_id', 'order_id');
    }
}
