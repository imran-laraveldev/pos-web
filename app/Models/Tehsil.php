<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Contracts\Auditable;

class Tehsil extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'tehsils';
    protected $fillable = ['name', 'name_ur', 'slug', 'district_idfk'];

    protected function rules($data, $update = '')
    {

        return Validator::make($data, [
            //'project_id' => 'required',
            'district_idfk' => 'required',
            'name' => 'required|unique:tehsils,name,' . $update . ',id|regex:/^[a-zA-Z ]*$/',

        ], [
                'district_idfk.required' => 'District field is required',
                'name.required' => 'Tehsil field is required',
                'name.unique' => 'Tehsil already exist',
                'name.regex' => 'Only alphabets are allowed '
            ]

        );

    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_idfk');
    }

    public function scopeActive($query)
    {
        return $query->where(['deleted_at' => null]);
    }

    function labels()
    {
        return $labels = array(
            'id' => 'Primary Key',
        );
    }

    public function module_name()
    {
        return "Tehil";
    }

    function relational_name()
    {
        return [];
    }
}
