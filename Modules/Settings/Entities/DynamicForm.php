<?php

namespace Modules\Settings\Entities;

use App\Models\Navigation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Services\userRelationTrait;

class DynamicForm extends Model
{
    use HasFactory;
    use userRelationTrait;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\DynamicFormFactory::new();
    }

    function formEntries()
    {
        return $this->hasMany(DynamicFormEntry::class,'dynamic_form_id','id');
    }

    function formEntriesCheckbox()
    {
        return $this->formEntries()->where('control_type', 'checkbox');
    }

    function navigation()
    {
        return $this->belongsTo(Navigation::class);
    }
}
