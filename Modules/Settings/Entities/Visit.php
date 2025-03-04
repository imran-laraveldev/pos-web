<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Services\userRelationTrait;

class Visit extends Model
{
    use HasFactory;
    use userRelationTrait;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\VisitFactory::new();
    }

    function branch()
    {
        return $this->belongsTo(Branch::class,'branch_idfk', 'id');
    }

    function history()
    {
        return $this->hasMany(VisitHistory::class,'visit_idfk', 'id');
    }

    function visit_gate()
    {
        return $this->belongsTo(VisitGate::class,'gate_idfk', 'id');
    }

    function visit_type()
    {
        return $this->belongsTo(VisitType::class,'type_idfk', 'id');
    }
}
