<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Contracts\Auditable;

class District extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'districts';
    protected $fillable = ['name', 'name_ur', 'slug', 'division_idfk'];

    protected function rules($data, $update = '')
    {
        return Validator::make($data, [
            'division_idfk' => 'required',
            // 'name' => 'required',
            // 'name'  => 'required|unique:districts,dist_name,' . $update.',dist_id',
            'name' => 'required|unique:districts,name,' . $update . ',id|regex:/^[a-zA-Z ]*$/',
        ], [
                'division_idfk.required' => 'Division field is required',
                'name.unique' => 'District already exist',
                'name.required' => 'District field is required'
            ]
        );
    }

    public function tehsils()
    {
        return $this->hasMany(Tehsil::class, 'teh_district_idfk');
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
        return "District";
    }

    function relational_name()
    {
        return [];
    }
}
