<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\VerifyEmail;


class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'username' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20','required_with:password_confirmation'],
            'password_confirmation' => 'required|same:password|min:4|max:20',
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user); 
        return redirect('/verify-email');
    }

    public function verifyEmail(){
        return view('session.verify-email');
    }

    public function sendVerifyEmail(){

        /* $user = User::where('email',request()->email)->first();
        Mail::to(request()->email)->send(new VerifyEmail($user)); */
        return view('session.welcome-lauz');
    }

    public function reSendVerifyEmail(){
        $user = User::where('email',request()->email)->first();
        Mail::to(request()->email)->send(new VerifyEmail($user));
        session()->flash('success', 'Email was sent successfully.');
        return redirect('/dashboard');

    }

    public function goDashboard(){
        return redirect('/dashboard');
    }

    public function userVerify($email){

        $user = User::where('email',$email)->update([
            'email_verify' => 1
        ]);

        session()->flash('success', 'Email verified successfully');
        return redirect('/dashboard');
    }

    public function quiz(){
        return view('session.quiz');
    }

    public function storeQuiz(){
        $attributes = request()->validate([
            'how_long_invest' => ['required'],
            'how_often_invest' => ['required'],
            'looking' => ['required'],
            'investment_type' => 'required',
        ]);
        $attributes['user_id'] = auth()->user()->id;

        $quiz = Quiz::create($attributes);
        return redirect('/dashboard');
    }
}
