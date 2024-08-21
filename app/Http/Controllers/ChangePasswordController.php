<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    /**
     * Change the user's password using a reset token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Reset the user's password using the provided token and new password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // Check if the password reset was successful
        if ($status === Password::PASSWORD_RESET) {
            // Redirect the user to the login page with a success message
            return redirect('/login')->with('success', __($status));
        } else {
            // Return an error response with the appropriate message
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
