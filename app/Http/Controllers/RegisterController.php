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
    /**
     * Create a new user registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('session.register');
    }

    /**
     * Store a newly created user in the storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Show the page to verify the email.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function verifyEmail()
    {
        return view('session.verify-email');
    }

    /**
     * Send a verification email to the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendVerifyEmail()
    {
        /* $user = User::where('email',request()->email)->first();
        Mail::to(request()->email)->send(new VerifyEmail($user)); */
        return view('session.welcome-lauz');
    }

    /**
     * Resend a verification email to the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reSendVerifyEmail()
    {
        $user = User::where('email',request()->email)->first();
        Mail::to(request()->email)->send(new VerifyEmail($user));
        session()->flash('success', 'Email was sent successfully.');
        return redirect('/dashboard');
    }

    /**
     * Go to the dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function goDashboard()
    {
        return redirect('/dashboard');
    }

    /**
     * Verify the user's email.
     *
     * @param string $email
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userVerify(string $email)
    {
        $user = User::where('email',$email)->update([
            'email_verify' => 1
        ]);

        session()->flash('success', 'Email verified successfully');
        return redirect('/dashboard');
    }

    /**
     * Show the quiz form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quiz()
    {
        return view('session.quiz');
    }

    /**
     * Store the user's quiz answers.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeQuiz()
    {
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
