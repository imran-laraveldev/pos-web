<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $__userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->__userService = $userService;
    }

    public function listing()
    {
        $data['title'] = 'Users';
        $data['rows'] = $this->__userService->getAll();
        return view('acl.users_listing',$data);
    }

    public function show($id)
    {
        $data['row'] = $this->__userService->get($id);
        return view('acl.users_view',$data);
    }

    public function create(Request $request)
    {
        $province_id = $request->post('province_idfk') ?? 6;
        $data['provinces'] = $this->__userService->getProvinceAll();
        $data['divisions'] = $this->__userService->getDivisionsByProviceId($province_id);
        return view('acl.users_create',$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'province_idfk' => 'required',
            'division_idfk' => 'required',
            'district_idfk' => 'required',
            'tehsil_ids' => 'required',
        ],[
            'password.confirmed' => 'The password does not match',
            'province_idfk.required' => 'The province field is required.',
            'division_idfk.required' => 'The division field is required.',
            'district_idfk.required' => 'The district field is required.',
            'tehsil_ids.required' => 'The tehsil field is required.',
        ]);

        $data = $request->all();
        #$validator = $this->__userService->validateUser($data);
        $this->__userService->createUser($data);
        return redirect()->route('acl.user.listing');
    }

    protected function validator(array $data)
    {
        $reponse = $this->__userService->validateUser($data);
        echo json_encode($reponse);
    }
}
