<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Services\userRelationTrait;

class Province extends Model
{
    use HasFactory;
    use userRelationTrait;

    protected $table = ['provinces'];
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\ProvinceFactory::new();
    }
}
