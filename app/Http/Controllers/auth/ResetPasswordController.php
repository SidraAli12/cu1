<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.resetpassword');
    }

   public function reset(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'No user found with this email address.',
        ], 404);
    }

    $user->password = Hash::make($request->password);
    $user->setRememberToken(Str::random(60));
    $user->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Password has been reset successfully!',
        'redirect' => route('login'),
    ]);
}
}