<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests;
use Validator;
use Auth;
use App\User;
use App\User_specialty;
use App;
use Hash;
use Mail;
use CountryState;

class AdminController extends Controller
{
    /**
     * Display admin login blade
    */
    public function login()
    {

        //check if admin login
        if(auth()->user())
        {
            return redirect('login');
        }
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.login'),
            'submit_button'=>trans('cpanel.login')
        ];
        return view('login')->with($data);
    }

    /**
     * Ckeck if this user already exist in database or not.
    */
    public function loginAdmin(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'email'                 => trans('cpanel.email'),
            'password'              => trans('cpanel.password'),
            ]);
        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }else{
            if($request->input('remember') ==1)
            {
                $remember = true;
            }else{
                $remember = false;
            }
            if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password'),'status'=>1],$remember))
            {
                if(User::GetRole() == 'admin')
                {
                    // return view(AD.'/frontend/get_start');
                    return redirect('/');
                }else{
                    return redirect('/');
                }
            }else{
                session()->flash('error_login',trans('cpanel.error_login'));
                return redirect()->back();
            }
        }
    }

    /**
    * forgotPassword
    *
    **/
    public function forgotPassword()
    {
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.forgot')
        ];
        return view('forgot_password')->with($data);
    }

    public function sendPassword(Request $request)
    {
        $rules = [
            'email'      => 'required|email',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'email'      => trans('cpanel.email'),
            ]);
        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }else{
            $email    = $request->input('email');
            $user     = User::where('email', '=', $email)->first();
            if(!empty($user)){

            }else{
                session()->flash('not_user',trans('cpanel.not_user'));
                return redirect()->back();
            }
        }
    }
    /**
     * Logout clear session to user.
     *
     * @return to login page
    */
    public function logout()
    {

        Auth::logout();
        Session()->flush();
        return redirect('/');
    }

    /**
     * Display Home.
     *
     * @return \Illuminate\Http\Response
     */
    public function home($locale='ar')
    {
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.home')
        ];
        return view(AD.'.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      if(!auth()->user())
      {
          return redirect('login');
      }
        $all_admins  = User::all();
        $data = [
            'title'=>'site_name',
            'page_title'=>'admins',
            'all_admins'=>$all_admins,
        ];

        return view(AD.'.admins.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types  = User::GetAdminTypes();
        $data = [
            'title'=>'site_name',
            'page_title'=>'add_admin',
            'type'=>'add',
            'form_title'=>'admin_form',
            'submit_button'=>'save',
            'types'=>$types,
        ];
        return view(AD.'.admins.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules=[
            'name'                      =>'required',
            'email'                     =>'required|email|unique:users',
            'password'                  =>'required|min:8|confirmed',
            'password_confirmation'     =>'required|min:8',
            'phone'                     =>'required|min:10',
            'permissions'               =>'required',
            'status'                    =>'required|integer',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'name'                      =>trans('cpanel.name'),
            'email'                     =>trans('cpanel.email'),
            'password'                  =>trans('cpanel.password'),
            'password_confirmation'     =>trans('cpanel.password_confirmation'),
            'phone'                     =>trans('cpanel.phone'),
            'permissions'               =>trans('cpanel.admin_type'),
            'status'                    =>trans('cpanel.status'),

        ]);
        if($validator->fails())
        {
            session()->flash('error_msg', trans('cpanel.form_error'));

            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        }else{

            $add = new User;
            $add->name                    = $request->input('name');
            $add->email                   = $request->input('email');
            $add->password                = bcrypt($request->input('password'));
            $add->career                  = $request->input('career');
            $add->short_description       = $request->input('short_description');
            $add->birthdate               = $request->input('birthdate');
            $add->country                 = $request->input('country');
            $add->city                    = $request->input('city');
            $add->phone                   = $request->input('phone');
            $add->gender                  = $request->input('gender');
            $add->status                  = $request->input('status');
            $add->permissions             = $request->input('permissions');
            $add->save();
            // Send mail
            Mail::send('emails.sign_up', ['data' => $add], function ($m) use ($add) {
                $m->from('master@lodex.com', trans('cpanel.sign_up'));
                $m->to($add->email, $add->name)->subject( trans('cpanel.Welcome_in').' '.trans('cpanel.site_name'));
            });


              $user_id=$add->id;
              Auth::loginUsingId($user_id);
            session()->flash('success_msg', trans('cpanel.form_success'));
            return redirect('admins');
        }
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
        $admin_data = User::findOrFail($id);
        $types  = User::GetAdminTypes();
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.edit_admin'),
            'submit_button'=>trans('cpanel.save'),
            'admin_data'=>$admin_data,
            'type'=>'edit',
            'form_title'=>trans('cpanel.admin_form'),
            'types'=>$types,
        ];
        return view(AD.'.admins.form')->with($data);
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
        // return $request->all();
        $rules=[
            'name'                      =>'required',
            'email'                     =>'required|email|unique:users,email,'.$id,
            'password'                  =>'required|min:8|confirmed',
            'password_confirmation'     =>'required|min:8',
            'phone'                     =>'required|min:10',
            'permissions'               =>'required',
            'status'                    =>'integer',
        ];
        // Check if He/She want to change password
        if(!empty($request->input('password')) && $request->input('password')!= null)
        {
            $rules['password']='min:8|confirmed';
            $rules['password_confirmation']='min:8';
        }

        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
          'name'                      =>trans('cpanel.name'),
          'email'                     =>trans('cpanel.email'),
          'password'                  =>trans('cpanel.password'),
          'password_confirmation'     =>trans('cpanel.password_confirmation'),
          'phone'                     =>trans('cpanel.phone'),
          'permissions'               =>trans('cpanel.admin_type'),
          'status'                    =>trans('cpanel.status'),

        ]);
        if($validator->fails())
        {
            session()->flash('error_msg', trans('cpanel.form_error'));
            return back()->withInput()->withErrors($validator);
        }else{
            $edit = User::findOrFail($id);
            $edit->name              = $request->input('name');
            $edit->email             = $request->input('email');
            if(!empty($request->input('password')))
            {
                $edit->password      = bcrypt($request->input('password'));
            }

            if(auth()->user()->id != $edit->id)
            {
                $edit->status        = $request->input('status');
            }

            $edit->permissions       = $request->input('permissions');
            $edit->career                  = $request->input('career');
            $edit->short_description       = $request->input('short_description');
            $edit->birthdate               = $request->input('birthdate');
            $edit->country                 = $request->input('country');
            $edit->city                    = $request->input('city');
            $edit->phone                   = $request->input('phone');
            $edit->gender                  = $request->input('gender');
            $edit->save();
            session()->flash('success_msg', trans('cpanel.form_success'));
            return redirect('admins');
        }
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::findOrFail($id);
        $delete->delete();
        session()->flash('success_msg', trans('cpanel.form_success'));
        return back();
    }

    /**
    * Delete Selected ids
    **/
    public function DeleteSelectedAdmins(Request $request)
    {
        $ids = explode(",",$request->input('select_ids'));
        User::destroy($ids);
        session()->flash('success_msg', trans('cpanel.form_success'));
        return back();
    }

    /**
    * @return view file upload blade
    */
    public function uploadFiles()
    {
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.site_name'),
        ];
        return view(AD.'.admins.file_upload')->with($data);
    }

    /**
    * save files
    */
    public function saveuploadFiles(Request $request)
    {
        $add = new Photo;
        $path = public_path().'/uploads/photos';
        foreach ($request->file('files') as $photo) {
            $file_name = date('YmdHis').mt_rand().'photos.'.$photo->getClientOriginalExtension();
            if($photo->move($path,$file_name))
            {
                $add->photo = $file_name;
                $add->save();
            }
        }
        return response()->json([
            'success' =>true
        ]);
    }
}
