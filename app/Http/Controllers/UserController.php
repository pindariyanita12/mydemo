<?php

namespace App\Http\Controllers;

use App\Models\feedbackk;
use App\Models\Liter;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Adding liters.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        try {
            $request->validate([
                'liter' => 'required',

            ]);

            $liter = new Liter;
            $user = new User;
            $data = $user->where('is_superadmin', 1)->get();
            $liter->date = $request->date;
            $liter->day = $request->day;
            $liter->time = $request->time;
            $liter->area = $request->area;
            $liter->liter = $request->liter;
            $liter->rupees = (float) ($data[0]['price']) * ($request->liter);
            $liter->user_id = auth()->user()->id;
            $liter->save();

        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return redirect('/userdashboard');

    }

    /**
     * Update user profile
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

        return view('updateprofile')->with('user', $user);
    }
    /**
     * Save updated user
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
        return redirect('/dashboard');
    }
    public function getfeedback(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required',

            ]);

            $liter = new feedbackk;

            $liter->name = $request->name;
            $liter->email = $request->email;
            $liter->subject = $request->subject;
            $liter->message = $request->message;
            $liter->save();

        } catch (\Exception $e) {
            return view('demoexception', ['errors' => $e]);
        }
        return view('thankyou');
    }

}
