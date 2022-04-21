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
//return response()->json([$user]);
        if ($user[0]['is_admin'] == 1) {
            $data = Liter::where('area', auth()->user()->area)->with('user')->get();
            //return response()->json([$data]);
            //dd($data[0]->user->name);
            return view('admindashboard', ['liters' => $data]);
        } else if ($user[0]['is_superadmin'] == 1) {
            $data = User::where('is_admin', 1)->get();
            // return response()->json([$data]);
            return view('superadmindashboard', ['admins' => $data]);
        }

        $data = Liter::where('user_id', auth()->user()->id)->get();

        //event(new NewUserRegistered(auth()->user()));
        return view('dashboard', ['liters' => $data]);

    }
    public function index2()
    {
        $user = User::where('id', auth()->user()->id)->get();
//return response()->json([$user]);
        if ($user[0]['is_admin'] == 1) {
            $data = Liter::where('area', auth()->user()->area)->with('user')->get();
            //return response()->json([$data]);
            //dd($data[0]->user->name);
            return view('admindashboard', ['liters' => $data]);
        } else if ($user[0]['is_superadmin'] == 1) {
            $data = User::where('is_admin', 1)->get();
            // return response()->json([$data]);
            return view('superadmindashboard', ['admins' => $data]);
        }

        $data = Liter::where('user_id', auth()->user()->id)->get();

        return view('dashboard', ['liters' => $data]);

    }
    public function welcome(){
        return view('thankyouforpayment');
    }

}
