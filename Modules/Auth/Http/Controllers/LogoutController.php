<?php


namespace Modules\Auth\Http\Controllers;


use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController
{
    public function __invoke()
    {
        Session::flush();
        Auth::logout();
        return redirect()->to(RouteServiceProvider::HOME);
    }
}
