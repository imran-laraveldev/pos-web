<?php


namespace App\Services;


use App\Models\Department;
use App\Models\District;
use App\Models\Division;
use App\Models\Navigation;
use App\Models\Province;
use App\Models\User;
use Modules\Settings\Entities\Category;
use Modules\Settings\Entities\DynamicForm;

class BaseService
{
    use AttachableService,AclServiceTrait;

    function getUserById($id)
    {
        return User::find($id);
    }

    function getUsersByRole($role=4)
    {
        return User::role($role)->get();
    }

    function getCategories()
    {
        return Category::Raw('department_id as id,name')->get();
    }

    function getReportAll()
    {
        return Report::all();
    }

    function getGrantAll()
    {
        return Grant::all();
    }

    function getFundCenterAll($grantId=null)
    {
        $query = FundCenter::query();
        if (!is_null($grantId)) {
            $query->where('grant_idfk', $grantId);
        }
        return $query->get();
    }

    function getProvinceAll()
    {
        return Province::all();
    }

    function getDivisionsByProviceId($id=6)
    {
        return Division::where('province_idfk', $id)->get();
    }

    function getDistrictAll()
    {
        return District::all();
    }

    function getDepartmentAll()
    {
        return Department::all();
    }

    function getDepartment($department_id)
    {
        return Department::find($department_id);
    }

    function getParentNavs()
    {
        return Navigation::select('id','name')->where('parent_id','0')->get();
    }

    function getDesignations()
    {
        return Designation::where('role_id', '5')->get();
//        if (isSolicitor()) {
//            return Designation::where('role_id', '3')->get();
//        } elseif (isAdvocate()) {
//            return Designation::where('role_id', '4')->get();
//        } else {
//            return Designation::all();
//        }
    }

    function getDashboardStats()
    {
        $forms = DynamicForm::orderBy('node_name')->get();
        $result = [];
        foreach ($forms as $form) {
            $query = \DB::table($form->schema_name);
            if ($form->soft_delete) {
                $query->whereNull('deleted_at');
            }
            $total = $query->count();
            $result[] = ['node_name' => $form->node_name,
                'total' => $total ?? rand(100,999),
                'route_url' => route($form->schema_name,$form->id),
                'creator' => $form->creator->name];
        }
        return $result;
    }
}
