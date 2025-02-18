<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
    protected $__userService;

    function __construct(UserService $userService)
    {
        parent::__construct();
        $this->__userService = $userService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('pos-api-token')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function loginv1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|string|exists:users,username",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return $this->httpResponse->setResponse($validator->errors()->first(),[],self::STATUS_VALIDATION_FAILED);
        }

        $username = $request->post('username');
        $password = $request->post('password');
        // Officer object
        $user = $this->__userService->findWhere(['username' => $username]);

        if (!empty($user)) {
            // check can login or not
            if ($user && $user->status === 0) {
                return $this->httpResponse->setResponse('You are not authorized to log in. Please reach out to the administration team.'
                    , [],self::STATUS_UNAUTHORIZED);
            }
            // Check password
            if (!$user || !Hash::check($password, $user->password)) {
                return $this->httpResponse->setResponse('Username or Password Invalid',[], self::STATUS_UNAUTHORIZED);
            }

            $this->__userService->authenticate($user,$password);

            return $this->httpResponse->setResponse('Successfully Logged In.', new UserResource($user));
        }

        return $this->httpResponse->setResponse('Username or Password Invalid!',[],self::STATUS_VALIDATION_FAILED);
    }
}
