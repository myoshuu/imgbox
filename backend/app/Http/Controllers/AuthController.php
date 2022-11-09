<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if ($validator->fails() || !(Auth::attempt($request->all()))) {
      return response()->json(['message' => 'invalid credentials'], 401);
    }

    $user = auth()->user();
    $token = $user->createToken('token')->plainTextToken;

    return response()->json(['message' => 'login success', 'token' => $token, 'user' => $user], 200);
  }

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'nama' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'confirm_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
      return response()->json(['message' => 'invalid credentials'], 401);
    }

    $user = new User();
    $user->nama = $request->nama;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json(['message' => 'register success'], 200);
  }

  public function profile()
  {
    $user = auth()->user();
    return response()->json(['message' => 'success', 'data' => $user], 200);
  }

  public function logout()
  {
    auth()->user()->tokens()->delete();
    return response()->json(['message' => 'logout success'], 200);
  }
}
