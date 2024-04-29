<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\User\Entities\User;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm(){
        return view('auth::login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', $data['username'])->where('password', $data['password'])->first();

        if(!$user):
            return redirect()->to('login')
            ->with('error', 'Bagyşlaň! Siz nädogry maglumat girizdiňiz.');
        endif;

        // $credentials = $request->getCredentials();

        // if(!Auth::validate($credentials)):
        //     return redirect()->to('login')
        //     ->with('error', 'Bagyşlaň! Siz nädogry maglumat girizdiňiz.');
        // endif;

        // $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return redirect()->intended('/')->with('success', 'You have Successfully loggedin');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
