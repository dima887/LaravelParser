<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AuthUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * User authorization
     *
     * @return Renderable
     */
    public function loginAuth()
    {
        return view('auth.loginAuth');
    }

    /**
     * New User Registration
     *
     * @return Renderable
     */
    public function registerUser()
    {
        return view('auth.registerUser');
    }

    /**
     * User Authentication
     *
     * @param AuthUserRequest $request
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function authenticate(AuthUserRequest $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials, true)) {
            session()->flash('success', 'Вы успешно авторизовались');
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Логин или пароль не совпадают');

    }

    /**
     * Saving a new user to the database
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        session()->flash('success', 'Вы успешно зарегистрировались');
        Auth::login($user);
        return redirect()->route('home');
    }

    /**
     * Sign Out
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
