<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Liter;
use App\Models\Feedback;
use App\Models\feedbackk;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {

        $request->validate([
            'liter' => 'required',

        ]);

        $liter = new Liter;

        $liter->date = $request->date;
        $liter->day = $request->day;
        $liter->time = $request->time;
        $liter->area = $request->area;
        $liter->liter = $request->liter;
        $liter->rupees=60*(float)($request->liter);
        $liter->user_id = auth()->user()->id;

        $liter->save();

        return redirect('/userdashboard');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd("hi");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
    public function updateProfile(){

        $user=User::where('id',auth()->user()->id)->first();
        // dd($user);
        return view('updateprofile')->with('user',$user);
    }
    public function updateSaveUser(Request $req){
        $user=User::where('id',auth()->user()->id)->first();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->phone_number=$req->phone_number;
        $user->address=$req->address;

        $user->save();
        return redirect('/dashboard');
    }
    public function getfeedback(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required'

        ]);

        $liter = new feedbackk;

        $liter->name = $request->name;
        $liter->email = $request->email;
        $liter->subject = $request->subject;
        $liter->message = $request->message;

        $liter->save();


        return view('thankyou');
    }

}
