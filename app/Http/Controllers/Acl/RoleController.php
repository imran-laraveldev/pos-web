<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    protected $__permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->middleware('auth');
        $this->__permissionService = $permissionService;
    }

    public function listing()
    {
//        if (!hasPermission(\request()->route()->getName().'-view')) {
//            return redirect('unauthorized')->with('err', 'You don\'t have permission to perform this action. Please contact admin.');
//        }

        $data['title'] = 'Roles';
        $data['mainHeading'] = 'Role List';
        $data['singularTitle'] = 'Roles';
        $data['rows'] = []; //$this->__permissionService->getAllRole();
        return view('acl.roles_listing', $data);
    }

    public function getAjaxListData(Request $request)
    {
        if (!hasPermission(\request()->route()->getName() . '-view')) {
//            return json_encode([
//                "draw" => 1,
//                "recordsTotal" => 0,
//                "recordsFiltered" => 0,
//                "data" => [],
//            ]);
        }

        $results = $this->__permissionService->getSearchList($request);
        $user_id = Auth::user()->id;
//        dump($results->toSql()); dd('dd');
        return \DataTables::eloquent($results)
            ->editColumn('created_at', function ($query) {
                return date('d/m/Y', strtotime($query->created_at));
            })->editColumn('permissions', function ($query) use ($request) {
                return in_array($query->name, ['Admin']) ? 'all' :
                    $query->permissions->pluck('name')->implode(', ');
            })->orderColumn('name', function ($query, $order) {
                $query->orderBy('name', $order);
            })->addColumn('action', function ($query) use ($request) {

                $view_button = '';
                if (hasPermission('roles-view')) {

                    $view_url = route('acl.role.show', ($query->id));
                    $view_button = "<a href='$view_url' data-toggle='tooltip' title=\"View\"
                                       class='btn btn-sm btn-primary btn-float btn-action'><i class='fa fa-eye'></i>View</a>";
                }
                $edit_button = '';
                if (hasPermission('roles-edit')) {
                    $edit_url = route('acl.role.edit', ($query->id));
                    $edit_button = "<a href='$edit_url' class='btn btn-sm btn-warning btn-float btn-action'><i
                                class='edit-clr'></i>Edit</a>";
                }

                $update_button = '';
                if (hasPermission('roles-del')) {

                    $update_url = route('acl.role.del', ($query->id));
                    $update_button = "<button data-del-link='$update_url' class='btn btn-sm btn-float btn-action btn-secondary'
                                              onclick='delete_role(this)' disabled><i
                                class='fa fa-delete'></i>Del</button>";
//                    $update_button = "<a href='$update_url' class='btn btn-sm btn-danger btn-float btn-action '><i
//                                class='md-close'></i></a>";
                }

                $delete_button = '';
                return in_array($query->name, ['Admin']) ? '' : "$view_button $edit_button $update_button $delete_button";
            })
            ->rawColumns(['executor_name', 'status', 'created_at', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $data['mainHeading'] = 'Role View';
        $data['singularTitle'] = 'Roles';
        $data['navs'] = $this->__permissionService->getAllNavigations();
        $permissions = $this->__permissionService->getAll();
        $permissionArr = [];
        foreach ($data['navs'] as $nav) {
            $permissionArr[$nav->slug] = $permissions->filter(function ($item) use ($nav) {
                if (str_starts_with($item->name, $nav->slug)) {
                    return $item;
                }
            });
        }
        $data['permissions'] = $permissionArr;
        $data['role'] = $this->__permissionService->getRole($id);
        return view('acl.roles_view', $data);
    }

    public function create(Request $request)
    {
        $province_id = $request->post('province_idfk') ?? 6;
        $data['provinces'] = $this->__permissionService->getProvinceAll();
        $data['divisions'] = $this->__permissionService->getDivisionsByProviceId($province_id);
        return view('acl.roles_create_modal', $data);
//        return view('acl.roles_create',$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = $request->all();
        #$validator = $this->__permissionService->validateUser($data);
        $role = $this->__permissionService->createRole($data);
        if ($role) {
            echo json_encode(['success' => true, 'success_message' => 'Created successfully!']);
        } else {
            echo json_encode(['success' => false, 'success_message' => 'invalid data!']);
        }
//        return redirect()->route('roles-list');
    }

    public function edit($id)
    {
        $data['mainHeading'] = 'Role Edit';
        $data['singularTitle'] = 'Roles';
        $data['navs'] = $this->__permissionService->getAllParentNavigations();
        $permissions = $this->__permissionService->getAll();
        $permissionArr = [];
        foreach ($data['navs'] as $nav) {
            $permissionArr[$nav->slug] = $permissions->filter(function ($item) use ($nav) {
                if (str_starts_with($item->name, $nav->slug)) {
                    return $item;
                }
            });
        }
        $data['permissions'] = $permissionArr;
        $data['role'] = $this->__permissionService->getRole($id);
        return view('acl.roles_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role-permission' => 'required',
        ], [
            'role-permission.required' => 'No role permission selected.',
        ]);

        $data = $request->all();
        $this->__permissionService->updateRolePermissions($id, $data['role-permission']);
        session()->flash('status', 'Role updated successfully!!');
        return redirect()->route('roles')->with('message', 'Role updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $model = $this->__permissionService->getRole($id);
        $message = 'Invalid ID';
        if ($model) {
            $model->delete();
            $message = 'Role deleted successfully!';
            session()->flash('status', $message);
        }

        return redirect()->route('roles')->with('message', $message);
    }

}
