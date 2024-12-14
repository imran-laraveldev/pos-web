<?php


namespace App\Services;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionService extends BaseService
{
    public function __construct() {}

    public function getAllRole()
    {
        return Role::all();
    }

    public function getSearchList($params)
    {
        $query = Role::query();
        if ($params['name'] != '') {
            $query->where(['name', $params['name']]);
        }
        $query->where('id', '!=', 8);
        return $query;
    }

    public function getRole($id)
    {
        return Role::findById($id);
    }

    public function updateRolePermissions($id,$permissions=[])
    {
        $role = Role::findById($id);
        $rolePermissions = Permission::whereIn('id', $permissions)->get();
        return $role->syncPermissions($rolePermissions);
    }

    function createRole($params)
    {
        return Role::create([
            'name' => $params['name'],
        ]);
    }

    public function getAll()
    {
        return Permission::all();
    }

    function get($id)
    {
        return Permission::find($id);
    }

    function queryPermissions($department_id=null)
    {
        $query = Permission::query();
        return $query->where('department_idfk', $department_id);
    }

    function filterUsers($where=[],$statusOnly=false)
    {
        $query = Permission::query();
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
}
