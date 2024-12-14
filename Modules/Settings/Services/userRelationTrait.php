<?php


namespace Modules\Settings\Services;


use App\Models\User;

trait userRelationTrait
{
    function creator()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    function updator()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}
