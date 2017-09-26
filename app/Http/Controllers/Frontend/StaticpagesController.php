<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Validator;
use App\Countries;
use App\Cities;
use Illuminate\Http\Request;

use App\Http\Requests;

use App;
use Hash;
use Mail;
use DB;
use Response;
use Session;

class StaticpagesController extends Controller
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
   public function AboutPage()
{
  return view(FE . '/v_about');

}

public function ContactUsPage()
{

    /* $data = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'address'=>$request->input('address'),
            'message'=>$request->input('message'),
            
        ];*/
          return view(FE . '/v_contact_us');//->with($data);
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



   public function store(Request $request)
    {


          $rules=[
              'name'                      =>'required',
              'email'                     =>'required',
              'address'                   =>'required',
              'message'                   =>'required',
          ];
          $validator = Validator::make($request->all(), $rules);
          $validator->SetAttributeNames([
              'name'                      =>'name',
              'email'                     =>'email',
              'address'                   =>'address',
              'message'                   =>'message',

          ]);
          if($validator->fails())
          {
               session()->flash('error_msg', trans('cpanel.form_error'));
            //return $request->all();
            return back()->withInput()->withErrors($validator);
          }else{
          
            $data = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'address'=>$request->input('address'),
            'message'=>$request->input('message'),
            
        ];
         /*echo $data['email'];
         return;
           print_r($data);
           return;*/


            /*  $add->name                    = $request->input('name');
              $add->email                   = $request->input('email');
              $add->address                 = $request->input('address');
              $add->message                 = $request->input('message');*/
            //  $add->save();
              // Send mail
            //  return $request->all();
              Mail::send('emails.contact_us', ['data' => $data], function ($m) use ($data) {
                  $m->from('master@lodex.com', 'test1');
                  $m->to('houida.abd.elnabe2015@gmail.com')->subject( trans('cpanel.Welcome_in').' '.trans('cpanel.site_name'));
              });


              /*Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
    $m->from('hello@app.com', 'Your Application');
    $m->to($user->email, $user->name)->subject('Your Reminder!');
}); */

        Session::flash('message', 'تم ارسال رسالتك بنجاح سوف يتم الرد على استفسارك فى اقرب وقت');
              Session::flash('alert-class', 'alert-success');
           $sess_locale=$request->session()->get('sess_locale');
            return redirect($sess_locale.'/contact-us');
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function show(Cases $cases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function edit(Cases $cases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cases $cases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cases $cases)
    {
        //
    }
}
