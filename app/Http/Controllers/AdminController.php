<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Liter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function showalldata()
    {
        $user = User::where('id', auth()->user()->id)->get();
        //return response()->json([$user]);
        if ($user[0]['is_admin'] == 1) {
            $data = Liter::where('area', auth()->user()->area)->with('user')->get();
            //return response()->json([$data]);

            return view('admindashboard', ['liters' => $data]);
        }

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
        //return response()->json([$user]);
        if ($user) {
            $data = User::where('is_admin', 1)->get();
            // return response()->json([$data]);
            return view('superadmindashboard', ['admins' => $data]);
        }

    }
    public function showalladmindashboard(Request $req)
    {

        $data = Liter::where('area', $req->area)->with('user')->get();

        //return response()->json([$data]);
        return view('showcustomersdata', ['liters' => $data]);

    }
    public function showallusers()
    {
        $data = User::where('area', auth()->user()->area)->where('is_admin', '=', null)->get();

        //return response()->json([$data]);
        return view('showallusers', ['liters' => $data]);
    }
    public function deleteuser(Request $req)
    {
        $complaint = User::find($req->id);
        $complaint->delete();
        //dd($complaint);
        session()->flash('status', 'successfully deleted');
        return Redirect::back();
    }
    public function deleteadmin(Request $req)
    {
        $complaint = User::find($req->id);
        $complaint->delete();
        //dd($complaint);
        session()->flash('status', 'successfully deleted');
        return Redirect::back();
    }
    public function showpastusers()
    {
        $user = User::onlyTrashed()->get();
        return view('showpastusers', ['liters' => $user]);
    }
    public function addadmin(Request $request)
    {

        //dd($request->all)
        $liter = new User;
        //dd("hi");
        $liter->name = $request->name;
        //dd($request->all);
        $liter->email = $request->email;
        $liter->phone_number = $request->phone_number;
        $liter->area = $request->area;
        $liter->address = $request->address;
        $liter->is_admin = $request->is_admin;
        $liter->password = Hash::make($request->password);
        //liter->password=$request->password_confirmation;
        $liter->save();

        return redirect('superadmindashboard');
    }
    public function updatesuperadminProfile()
    {

        $user = User::where('id', auth()->user()->id)->first();
        // dd($user);
        return view('updatesuperadminprofile')->with('user', $user);
    }
    public function updatesuperadminSaveUser(Request $req)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone_number = $req->phone_number;
        $user->address = $req->address;

        $user->save();
        return redirect('/admindashboard');
    }
    public function showpastadmins()
    {
        $user = User::onlyTrashed()->get();
        return view('showpastadmins', ['liters' => $user]);
    }
    public function weeklybill()
    {
        $user = User::where('is_admin', null)->where('is_superadmin', null)->get();
        //return response()->json([$user]);

        $data = Liter::where('user_id', auth()->user()->id)->get();

        return view('emails.weeklyReport', ['liters' => $data]);

    }
    public function send_mail(Request $request)
    {
        $details = [
            'subject' => 'Test Notification',
        ];

        $job = (new SendEmailJob($details))
            ->delay(now()->addSecond(1));

        dispatch($job);



        echo "Mail send successfully !!";
    }

}
