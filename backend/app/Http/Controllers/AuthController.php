<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    $id = $user->id;
    $token = Str::random(60);
    User::where('id', $id)->update(['remember_token' => $token]);

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

  public function profile(Request $request)
  {
    $user = User::where('remember_token', $request->token)->first();
    return $user;
  }

  public function logout(Request $request)
  {
    User::where('remember_token', $request->token)->update(['remember_token' => null]);
    return response()->json(['message' => 'logout success'], 200);
  }
}
