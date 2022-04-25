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

        try {
            $user = User::where('id', auth()->user()->id)->get();
            //return response()->json([$user]);
            if ($user[0]['is_admin'] == 1) {
                $user = User::where('area', auth()->user()->area)->where('is_admin', null)->with('liters')->get();
            }

        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('admindashboard', ['users' => $user]);
    }
    public function updateProfile()
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('updateadminprofile')->with('user', $user);
    }
    public function updateSaveUser(Request $req)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->phone_number = $req->phone_number;
            $user->address = $req->address;

            $user->save();

        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return redirect('/admindashboard');
    }
    public function superadmindata()
    {
        try {
            $user = User::where('is_admin', 1)->get();
            if ($user) {
                $data = User::where('is_admin', 1)->get();
            }
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('superadmindashboard', ['admins' => $data]);

    }
    public function showalladmindashboard(Request $req)
    {
        try {
            $data = Liter::where('area', $req->area)->with('user')->get();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }

        return view('showcustomersdata', ['liters' => $data]);

    }
    public function showallusers()
    {
        try {
            $data = User::where('area', auth()->user()->area)->where('is_admin', '=', null)->get();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('showallusers', ['liters' => $data]);
    }
    public function deleteuser(Request $req)
    {
        try {
            $complaint = User::find($req->id);
            $complaint->delete();

            session()->flash('status', 'successfully deleted');
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return Redirect::back();
    }
    public function deleteadmin(Request $req)
    {
        try {
            $complaint = User::find($req->id);
            $complaint->delete();
            //dd($complaint);
            session()->flash('status', 'successfully deleted');
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return Redirect::back();

    }
    public function showpastusers()
    {
        try {
            $user = User::onlyTrashed()->get();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('showpastusers', ['liters' => $user]);
    }
    public function addadmin(Request $request)
    {

        try {
            $liter = new User;

            $liter->name = $request->name;

            $liter->email = $request->email;
            $liter->phone_number = $request->phone_number;
            $liter->area = $request->area;
            $liter->address = $request->address;
            $liter->is_admin = $request->is_admin;
            $liter->password = Hash::make($request->password);

            $liter->save();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }

        return redirect('superadmindashboard');
    }
    public function updatesuperadminProfile()
    {
        try{
            $user = User::where('id', auth()->user()->id)->first();
        }

        catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('updatesuperadminprofile')->with('user', $user);
    }
    public function updatesuperadminSaveUser(Request $req)
    {
        try{
            $user = User::where('id', auth()->user()->id)->first();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->phone_number = $req->phone_number;
            $user->address = $req->address;

            $user->save();
        }
        catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }

        return redirect('/admindashboard');
    }
    public function showpastadmins()
    {
        try{
            $user = User::onlyTrashed()->get();
        }
        catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('showpastadmins', ['liters' => $user]);
    }
    public function weeklybill()
    {
        //$user = User::where('is_admin', null)->where('is_superadmin', null)->get();
        //return response()->json([$user]);
        try{
            $data = Liter::where('user_id', auth()->user()->id)->get();
        }
        catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }

        return view('emails.weeklyReport', ['liters' => $data]);

    }
    public function send_mail(Request $request)
    {
        try{
            $details = [
                'subject' => 'Test Notification',
            ];

            $job = (new SendEmailJob($details))
                ->delay(now()->addSecond(1));

            dispatch($job);

        }
        catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        echo "Mail send successfully !!";
    }

}
