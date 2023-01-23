<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
      $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
      ]);

      $credentials = request(['username', 'password']);
      
      if(!auth()->attempt($credentials))
      {
        return response()->json([
          'message' => 'Unauthorized',
          'statusCode' => 401,
        ], 401);
      }
      
      $user = $request->user();
      $tokenResult = $user->createToken('Personal Access Token');
      $token = $tokenResult->token;
      $token->save();

      return response()->json([
        'message' => 'Successfully Login!',
        'statusCode' => 200,
        'data' => [
          'access_token' => $tokenResult->accessToken,
          'token_type' => 'Bearer',
          'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
          'user' => $user,
        ]
      ],200);
    }

    public function register(Request $request){
        $request->validate([
          'email' => 'required|string|email|unique:users',
          'username' => 'required|string|unique:users',
          'password' => 'required|string|confirmed',
          'name' => 'required|string',
          'id_role' => 'required|string',
          'address' => 'required|string'
        ]);

        $users = new User;
        $users->email = $request->email;
        $users->name = $request->name;
        $users->username = $request->username;
        $users->address = $request->address;
        $users->password = bcrypt($request->password);
        $users->id_role=$request->id_role;
        $users->save();

        return response()->json([
            'message' => 'Successfully created user!',
            'statusCode' => 201,
            'data' => [
              'user' => $users
            ]
        ], 201);
    }
}
