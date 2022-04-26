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
    /**
     * Showing admin dashboard
     *
     * @return void
     */
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
    /**
     * Updating admin profile
     *
     * @return void
     */
    public function updateProfile()
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('updateadminprofile')->with('user', $user);
    }
    /**
     * Save admin updated profile
     *
     * @param Request $req
     * @return void
     */
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
    /**
     * Show superadmin dashboard
     *
     * @return void
     */
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
    /**
     * Show all admin dashboard in superadmin dashboard
     *
     * @param Request $req
     * @return void
     */
    public function showalladmindashboard(Request $req)
    {
        try {
            $data = Liter::where('area', $req->area)->with('user')->get();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('showcustomersdata', ['liters' => $data]);

    }
    /**
     * Show all users of admin in superadmin dashboard
     *
     * @return void
     */
    public function showallusers()
    {
        try {
            $data = User::where('area', auth()->user()->area)->where('is_admin', '=', null)->get();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('showallusers', ['liters' => $data]);
    }
    /**
     * Delete a user
     *
     * @param Request $req
     * @return void
     */
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
    /**
     * Delete admin
     *
     * @param Request $req
     * @return void
     */
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
    /**
     * Show deleted users
     *
     * @return void
     */
    public function showpastusers()
    {
        try {
            $user = User::onlyTrashed()->get();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('showpastusers', ['liters' => $user]);
    }
    /**
     * Add admin
     *
     * @param Request $request
     * @return void
     */
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
    /**
     * Update superadmin profile
     *
     * @return void
     */
    public function updatesuperadminProfile()
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('updatesuperadminprofile')->with('user', $user);
    }
    /**
     * Save updated superadmin profile
     *
     * @param Request $req
     * @return void
     */
    public function updatesuperadminSaveUser(Request $req)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->phone_number = $req->phone_number;
            $user->price = $req->price;
            $user->address = $req->address;
            $user->save();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return redirect('/admindashboard');
    }
    /**
     * Show deleted admins
     *
     * @return void
     */
    public function showpastadmins()
    {
        try {
            $user = User::onlyTrashed()->get();
        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('showpastadmins', ['liters' => $user]);
    }
    /**
     * Send mail to admin area users using job
     *
     * @param Request $request
     * @return void
     */
    public function send_mail(Request $request)
    {
        try {
            $details = [
                'subject' => 'Test Notification',
            ];

            $job = (new SendEmailJob($details))
                ->delay(now()->addSecond(1));

            dispatch($job);

        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        echo "Mail send successfully !!";
    }

}
