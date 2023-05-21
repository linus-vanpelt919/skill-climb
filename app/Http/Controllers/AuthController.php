<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
      /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index() {
        ///auth/loginにリダイレクト
        return redirect('/auth/login');
    }

    public function create(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json(['token' => $token], 201);
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
}

public function logout(Request $request) {
    $user = $request->user();
    if ($user) {
        $user->tokens()->delete();
    }
    return response()->json([
        'message' => 'ログアウトしました',
    ]);
}

public function user(Request $request) {
    // ユーザー情報取得処理
}
// public function token(Request $request) {
//     return $request->session()->token();
// }

//myPage用にユーザー情報を取得する
public function show(Request $request) {
    if (Auth::check()) {
        $user = Auth::user();
        return response()->json($user);
    } else {
        return response()->json(['message' => 'ログインしていません'], 401);
    }
}


}
