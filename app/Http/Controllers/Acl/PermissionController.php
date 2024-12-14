<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $__permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->middleware('auth');
        $this->__permissionService = $permissionService;
    }

    public function listing()
    {
        $data['title'] = 'Permissions';
        $data['rows'] = $this->__permissionService->getAll();
        return view('acl.permissions_listing',$data);
    }

    public function show($id)
    {
        $data['row'] = $this->__permissionService->get($id);
        return view('acl.permissions_view',$data);
    }
}
