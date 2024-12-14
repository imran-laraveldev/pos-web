<?php

namespace Modules\Settings\Entities;

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
        return \Modules\Settings\Database\factories\CategoryFactory::new();
    }
}
