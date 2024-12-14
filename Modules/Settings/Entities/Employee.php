<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Settings\Services\userRelationTrait;

class Employee extends Model
{
    use HasFactory,SoftDeletes;
    use userRelationTrait;

    protected $table = ['employee'];
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\EmployeeFactory::new();
    }
}
