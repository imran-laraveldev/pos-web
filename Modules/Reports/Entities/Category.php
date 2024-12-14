<?php

namespace Modules\Reports\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'mysql-pos';
    protected $table = 'departments';
    protected $guarded = ['department_id'];

    protected static function newFactory()
    {
        return \Modules\Reports\Database\factories\CategoryFactory::new();
    }

    function inventory()
    {
        return $this->belongsTo(Inventory::class, 'department_id', 'department_id');
    }
}
