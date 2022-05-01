<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLoginView(){
        return response()->view('cms.auth.login');
    }

    public function login(Request $request) {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:admins,email',
            // 'email' => 'required|email',
            'password' => 'required|string|min:3',
            'remember' => 'required|boolean',
        ]);
        if (!$validator->fails()) {
            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if (Auth::guard(session()->get('guard'))->attempt($credentials, $request->input('remember'))) {
                return response()->json(['message' => 'Logged in successfully']);
            } else {
                return response()->json(['message' => 'Login failed, check credentials'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
