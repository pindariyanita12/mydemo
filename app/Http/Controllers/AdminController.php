<?php

namespace App\Http\Controllers;

use App\Models\Liter;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function showalldata()
    {

        $data = Liter::where('area', auth()->user()->area)->get();
        //return response()->json([$data]);
        return view('admindashboard', ['liters' => $data]);

    }
    public function updateProfile()
    {

        $user = User::where('id', auth()->user()->id)->first();
        // dd($user);
        return view('updateadminprofile')->with('user', $user);
    }
    public function updateSaveUser(Request $req)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone_number = $req->phone_number;
        $user->address = $req->address;

        $user->save();
        return redirect('/admindashboard');
    }
    public function superadmindata()
    {
        $user = User::where('is_admin', 1)->get();
        return view('superadmindashboard', ['admins' => $user]);
    }
    public function showalladmindashboard(){
        $data = Liter::where('id', )->get();
    }

}
