<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService extends BaseService
{
    public function __construct()
    {

    }

    public function getAll()
    {
        return User::all();
//        return User::with('department')->get();
    }

    function get($id)
    {
        return User::find($id);
    }

    function queryUsers($department_id=null)
    {
        $query = User::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterUsers($where=[],$statusOnly=false)
    {
        $query = User::with('department');
        if ($statusOnly) {
            $query->where($where);
        } else {
            if (isAdmin()) {
                $caseAppeal = ['session','appeal-1','appeal-2'];
                if (sizeof($where)) {
                    $caseAppeal = ['session','appeal-1'];
                    if ($where[0][2] == 'all') $where = [];
                }
                $query->where('case_type', 'reference');
                $query->whereIn('case_appeal', $caseAppeal);
            } elseif(isManager()) {
                $query->where(function ($q){
                    $q->where('case_type', 'reference');
                    $q->whereIn('case_appeal', ['appeal-2','appeal-3']);
                });
                $query->orWhere('case_type', 'writ');

            }
            $query->where($where);
        }
        return $query;
    }

    function validateUser($params)
    {
        return Validator::make($params, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    function createUser($params)
    {
        return User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => Hash::make($params['password']),
            'province_idfk' => $params['province_idfk'],
            'division_idfk' => $params['division_idfk'],
            'district_idfk' => $params['district_idfk'],
            'tehsil_ids' => $params['tehsil_ids']
        ]);
    }
}
