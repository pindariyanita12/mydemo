<?php

namespace App\Http\Controllers;

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
        $user = User::where('id',auth()->user()->id)->get();
// return response()->json([$user]);
        if ($user[0]['is_admin'] == 1) {
            $data = Liter::where('area',auth()->user()->area)->get();
            //return response()->json([$data]);
            return view('admindashboard', ['liters' => $data]);
        }
        $data = Liter::where('user_id', auth()->user()->id)->get();
        return view('dashboard', ['liters' => $data]);

    }
}
