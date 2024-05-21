<?php


namespace Modules\Auth\Http\Controllers;


use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TimeoutController
{
    public function __invoke()
    {
        $user = auth()->user();
        $user->status = false;
        $user->save();
        Session::flush();
        Auth::logout();
        return redirect()->to(RouteServiceProvider::HOME);
    }
}
