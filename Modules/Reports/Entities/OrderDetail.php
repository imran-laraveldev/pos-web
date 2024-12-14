<?php

namespace Modules\Reports\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $connection = 'mysql-pos';
    protected $table = 'receipt';

    protected static function newFactory()
    {
        return \Modules\Reports\Database\factories\OrderFactory::new();
    }

    function order()
    {
        return $this->belongsTo(Order::class, 'receipt_id', 'order_id');
    }

    function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }
}
