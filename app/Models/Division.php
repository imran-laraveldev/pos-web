<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Division extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'divisions';
    protected $fillable = ['name', 'name_ur', 'slug', 'province_idfk'];

    protected function rules($data, $update = '')
    {
        return Validator::make($data, [
            'province_idfk' => 'required',
            'name' => 'required|unique:divisions,name,' . $update . ',id|regex:/^[a-zA-Z ]*$/',
        ], [
                'province_idfk.required' => 'Province field is required',
                'name.required' => 'Division field is required',
                'name.unique' => 'Division already exist'
            ]
        );
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_idfk');
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'division_idfk');
    }

    function labels()
    {
        return $labels = array(
            'id' => 'Primary Key',
        );
    }

    public function scopeActive($query)
    {
        return $query->where(['deleted_at' => null]);
    }

    public function module_name()
    {
        return "Division";
    }

    function relational_name()
    {
        return [];
    }
}
