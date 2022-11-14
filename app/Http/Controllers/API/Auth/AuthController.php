<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request){
          $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return $this->sendValidationError(['password' => ['Wrong email or password!']], 'Unauthorized User!', 422);
        }

        $user = Auth::user();
        return $this->sendSuccessResponse([
                'user' => $user,
                'token' => $token], 'User logged in successfully!');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
    
    /**
     * [forgetPassword description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if($status === Password::RESET_LINK_SENT){
            return $this->sendSuccessResponse([], __($status));
        }else{
            return $this->sendValidationError([], __($status), 422);
        } 
          
        }

        public function resetPassword(Request $request)
        {
            $request->validate([
               'token' => 'required',
               'email' => 'required|email',
               'password' => 'required|confirmed|min:3',   
            ]);

            $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function($user) use ($request){
                $user->forceFill(['password' => Hash::make($request->password), 'remember_token' => Str::random(60)])->save();
                event(new PasswordReset($user));
            });

            if($status == Password::PASSWORD_RESET){
                return $this->sendSuccessResponse([], 'Password reset successfully!');
            }else{
                return $this->sendValidationError([], __($status), 422);
            }
        }
}
