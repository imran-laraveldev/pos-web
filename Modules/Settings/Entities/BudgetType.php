<?php

namespace Modules\Settings\Entities;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BudgetType extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title','sector','sub_sector','department_idfk','created_by','updated_by'];

    public static function boot() {

        parent::boot();
        static::creating(function($model) {
            $model->created_by = optional(Auth::user())->id ?? '1';
        });
        static::updating(function($model) {
            $model->updated_by = Auth::user()->id;
            $model->updated_at = now();
        });
    }

    protected static function newFactory()
    {
        return \Modules\Settings\Database\factories\BudgetTypeFactory::new();
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_idfk','id');
    }

}
