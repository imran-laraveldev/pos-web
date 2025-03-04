<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Services\userRelationTrait;

class VisitGate extends Model
{
    use HasFactory,SoftDeletes;
    use userRelationTrait;

    protected $table = 'visit_gates';
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\VisitGateFactory::new();
    }
}
