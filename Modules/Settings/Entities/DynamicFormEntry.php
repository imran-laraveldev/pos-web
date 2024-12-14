<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DynamicFormEntry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\DynamicFormEntryFactory::new();
    }

    function dynamicForm()
    {
        return $this->belongsTo(DynamicForm::class);
    }
}
