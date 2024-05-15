<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Transaction\Entities\Transaction;

class HomeController extends Controller
{
    public function index(){

        if(auth()->user()->isRoleAdmin()){
            return view('home');
        }else{
            return view('client.home');
        }
    }

    public function notifications(){

        $transactions = Transaction::query()->where('user_id', auth()->user()->id)->latest()->get();
        return view('client.notifications',compact('transactions'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('auth::profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required_with:password_confirmation|min:6|confirmed',
        ]);

        if ($request->has('password')) {
            $request->merge(['password' => bcrypt($request->get('password_confirmation'))]);
        }

        $user = auth()->user();
        $user->update($request->all());
        return redirect()->back();
    }
}
