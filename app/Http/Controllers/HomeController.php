<?php

namespace App\Http\Controllers;

use App\Events\NewUserRegistered;
use App\Models\Liter;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->get();

        if ($user[0]['is_admin'] == 1) {
            $user = User::where('area', auth()->user()->area)->where('is_admin', null)->with('liters')->get();
            return view('admindashboard', ['users' => $user]);
        } else if ($user[0]['is_superadmin'] == 1) {
            $data = User::where('is_admin', 1)->get();

            return view('superadmindashboard', ['admins' => $data]);
        }

        $data = Liter::where('user_id', auth()->user()->id)->get();


        return view('dashboard', ['liters' => $data]);

    }

    public function welcome(){
        return view('thankyouforpayment');
    }

}
