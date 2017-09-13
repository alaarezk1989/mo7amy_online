<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests;
use Validator;
use Auth;
use App\User;
use App\User_specialty;
use App\Countries;
use App\Cities;
use App;
use Hash;
use Mail;
// use CountryState;
use DB;
use Response;
use Carbon\Carbon;
use Session;


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
    public function create()
    {
        //
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
              Session::flash('error_msg',  trans('cpanel.form_error'));
              Session::flash('alert-class', 'alert-danger');

                // return $request->all();
              // return back()->withInput()->withErrors($validator);
              return redirect('/#sign')->withInput()->withErrors($validator);
          }else{
            $user_id=uniqid('', true);
// $user_id=date('YmdHis') . mt_rand();
              $add = new User;
              $add->id                      =$user_id;
              $add->name                    = $request->input('name');
              $add->email                   = $request->input('email');
              $add->password                = bcrypt($request->input('password'));
              $add->career                  = $request->input('career');
              $add->short_description       = $request->input('short_description');
              $add->birthdate               = $request->input('birthdate');
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

                // $user_id=$add->id;

                Auth::loginUsingId($user_id);

              Session::flash('success_msg',  trans('cpanel.form_success'));
              Session::flash('alert-class', 'alert-success');
  // return auth()->user()->id;
              session(['user_id' => $user_id]);
              session(['user_obj' => $user_obj]);
              $sess_locale=$request->session()->get('sess_locale');
                return redirect($sess_locale.'/edit-profile/'.$user_id);
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
    public function edit($locale='ar',$id)
    {

          if(auth()->user()->id != $id){
              return redirect('/');
          }
          // return auth()->user();
          // return auth()->user()->id;
          // $states = CountryState::getStates('EG');
      //  $countries = CountryState::getCountries();

      $sess_locale= session('sess_locale');
      $sess_user_id= session('user_id');

          $admin_data = User::findOrFail($id);

          $locale_name=$locale.'_name';

          $all_countries = DB::table('countries')
              ->select($locale.'_name','id')
              ->orderBy('id')->get();

              $first_country_id=0;
              $countries=array();
              foreach ($all_countries as $country) {
                if($first_country_id <= 0){
                  $first_country_id=$country->id;
                }
                $countries[$country->id]=$country->$locale_name;
              }

          $states=array();

        $user_country_id =  DB::table('users')
          ->join('cities', 'cities.id', '=', 'users.city')
          ->join('countries', 'countries.id', '=', 'cities.country_id')
          ->select('countries.*')
           ->where('users.id', '=', $sess_user_id)
          ->first();

          $all_states =  DB::table('users')
            ->join('cities', 'cities.id', '=', 'users.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->select('cities.*')
             ->where('countries.id', '=', $user_country_id->id)
            ->get();
      
          foreach ($all_states as $state) {
            $states[$state->id]=$state->$locale_name;
          }

          $types  = User::GetAdminTypes();
          $specialty  = User::GetAdminSpecialty();
          $user_specialty  = user_specialty::where('user_id', '=', $id)->get();
          $selected_user_specialty = [];
          foreach( $user_specialty as $sp )
          {
              $selected_user_specialty[$sp->specialty] = $sp->specialty;
          }
          // return $selected_user_specialty;
            // return ($user_specialty);
          $data = [
              'title'=>trans('cpanel.site_name'),
              'page_title'=>trans('cpanel.edit_admin'),
              'submit_button'=>trans('cpanel.save'),
              'admin_data'=>$admin_data,
              'type'=>'edit',
              'form_title'=>trans('cpanel.admin_form'),
              'types'=>$types,
              'specialty'=>$specialty,
              'user_specialty'=>$selected_user_specialty,
              'countries'=>$countries,
              'states'=>$states,
              'permissions'=>auth()->user()->permissions,
              'sess_user_id'=>$sess_user_id,

          ];
          return view(FE.'.profile_setting')->with($data);
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
// print_r( $request->file('profile_picture'));
//           return $request->all();
          $rules=[
            'name'                      =>'required',
            'phone'                     =>'required|min:10',
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
            'password'                  =>trans('cpanel.password'),
            'password_confirmation'     =>trans('cpanel.password_confirmation'),
            'phone'                     =>trans('cpanel.phone'),
          ]);
          if($validator->fails())
          {

              Session::flash('error_msg',  trans('cpanel.form_error'));
              Session::flash('alert-class', 'alert-danger');
              return back()->withInput()->withErrors($validator);
          }else{

            $deafult_path = public_path() . '/uploads/user_img';
            $path = File::makeDirectory($deafult_path, 0775, true);
            if (!empty($request->file('profile_picture'))) {
                $file_name = date('YmdHis') . mt_rand() . '_user_img.' . $request->file('profile_picture')->getClientOriginalExtension();

                if ($request->file('profile_picture')->move($path, $file_name)) {
                    $img = $file_name;
                }
            } else {
                $img = '';
            }
              $sess_user_id= session('user_id');
              $edit = User::findOrFail($id);
              $edit->name              = $request->input('name');
              $edit->career             = $request->input('career');
              // if(!empty($request->input('password')))
              // {
              //     $edit->password      = bcrypt($request->input('password'));
              // }

              $edit->short_description       = $request->input('short_description');
              $edit->city                    = $request->input('city');
              $edit->birthdate               = $request->input('birthdate');
              $edit->gender                  = $request->input('gender');
              $edit->phone                   = $request->input('phone');
              $edit->image                   = $img;
              $edit->save();

              if(!empty($request->input('specialty'))){
                  User_specialty::where('user_id', '=', $id)->delete();

                  $specialty=$request->input('specialty');
                foreach ($specialty as $key => $specialty_value) {
                  $add = new User_specialty;
                  $add->id         =uniqid('', true);
                  $add->user_id    =$id;
                  $add->specialty    =$specialty_value;
                  $add->save();
                }
              }
              // session()->flash('success_msg', trans('cpanel.form_success'));
              Session::flash('message',  trans('cpanel.form_success'));
              Session::flash('alert-class', 'alert-success');
            $sess_locale=$request->session()->get('sess_locale');

              return redirect($sess_locale.'/edit-profile/'.$sess_user_id);
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
        //
    }




    /**
     * Ckeck if this user already exist in database or not.
    */
    public function user_login(Request $request)
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
            // return back()->withInput()->withErrors($validator);
            Session::flash('error_login',  trans('cpanel.error_login'));
            Session::flash('alert-class', 'alert-danger');
            return redirect('/#login')->withInput()->withErrors($validator);
        }else{
            if($request->input('remember') ==1)
            {
                $remember = true;
            }else{
                $remember = false;
            }
            if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password'),'status'=>1],$remember))
            {
              $user_obj = DB::table('users')
              ->where('email', '=', $request->input('email'))->first();
              session(['user_id' => $user_obj->id]);
              session(['user_obj' => $user_obj]);
              // return $user_obj->id;
                if(User::GetRole() == 'admin')
                {
                    // return view(AD.'/frontend/get_start');
                    return redirect('/');
                }else{
                    return redirect('/');
                }
            }else{


                return redirect()->back();
            }
        }
    }


    public function changePassword(Request $request)
      {
        // return $request->all();
        $rules=[
          'current_password'              =>'required',
          'new_password'                  =>'required|min:8|same:new_password',
          'password_confirmation'         =>'required|min:8|same:new_password',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
          'current_password'              =>trans('cpanel.current_password'),
          'new_password'                  =>trans('cpanel.password'),
          'password_confirmation'         =>trans('cpanel.password_confirmation'),
        ]);

        if($validator->fails())
        {
          return $request->all();

            Session::flash('error_msg',  trans('cpanel.form_error'));
            Session::flash('alert-class', 'alert-danger');
            return back()->withInput()->withErrors($validator);
        }else{
          $user = Auth::user();

          $curPassword = $request->input('current_password');
          $newPassword = $request->input('new_password');

          if (Hash::check($curPassword, $user->password)) {
              $user_id = $user->id;
              $obj_user = User::findOrFail($user_id);
              $obj_user->password = bcrypt($newPassword);
              $obj_user->save();
    // return $newPassword;
              // return response()->json(["result"=>true]);
          }
          else
          {
              // return response()->json(["result"=>false]);
          }
        }
          $sess_locale=$request->session()->get('sess_locale');
          return redirect($sess_locale.'/edit-profile/'.auth()->user()->id);
      }

      public function list_lawyers(){
        $specialty  = User::GetAdminSpecialty();


                        /*sections*/
        $sess_locale= session('sess_locale');
      $all_sections = DB::table('sections')
          ->where('local', '=', $sess_locale)->orderBy('id')->get();
          $first_section_id=0;
          $sections=array();
          foreach ($all_sections as $section) {
            if($first_section_id <= 0){
              $first_section_id=$section->id;
            }

            $sections[$section->id]=$section->name;
          }
/*sections*/


        $sess_locale= session('sess_locale');
       $all_countries = DB::table('countries')
          ->where('local', '=', $sess_locale)->orderBy('id')->get();
          $first_country_id=0;
          $countries=array();
          foreach ($all_countries as $country) {
            if($first_country_id <= 0){
              $first_country_id=$country->id;
            }

            $countries[$country->id]=$country->name;
          }

        $per_page = 8;

        $all_lawyers = DB::table('users')->where('permissions', '=', 'lawyer')
                ->Where('status', '=', '1')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
                /*
                $all_lawyers = User::where('permissions', '=', 'lawyer')
                        ->Where('status', '=', '1')
                        ->orderBy('created_at', 'desc')
                        ->paginate($per_page);
                */
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.edit_admin'),
            'per_page'=>$per_page,
            'all_lawyers'=>$all_lawyers,
            'countries'=>$countries,
            'sections'=>$sections,
        ];
          return view(FE.'.list_lawyers')->with($data);
      }




 public function filtering_al(Request $request){



      if($request->sections){
      $user_specialtyModel = DB::table('user_specialty')
        ->select('user_id')
        ->whereIn('specialty', (array)$request->sections)->distinct()->get();
        $user_ids=(array)$user_specialtyModel;
       // return $user_ids;
      }
      if($request->countries){
        $c_array=(array)$request->countries;
         $c_array=array_unique($c_array);
        $user_specialtyModel->whereIn('country', $c_array);

      }


$data_join = DB::table('users')
    ->join('user_specialty', 'users.id', '=', 'user_specialty.user_id')
    ->join('sections', 'sections.id', '=', 'user_specialty.specialty')

    ->join('cities', 'cities.id', '=', 'users.city')
    ->join('countries', 'countries.id', '=', 'cities.country_id')
    ->select('users.*','sections.name as s_name','cities.name as city_name','countries.name as country_name')
    ->groupBy('user_specialty.user_id')
    // ->where('followers.follower_id', '=', 3)
    ->get();

   /*
 echo "<pre>";
      print_r($user_specialtyModel);
      echo "</pre>";*/
      return;
      if($data_join){
        return response()->json(['code' => 200 , 'msg' => "success" , "data" => $data_join]);
      }else{
        return response()->json(['code' => 404 , 'msg' => "not found" ]);
      }

    }


   public function filtering(Request $request){

    $users_ids=array();
    $users_ids_sections=array();
    $users_ids_countries=array();

      if($request->sections){
         $user_specialtyModel = DB::table('user_specialty')
           ->select('user_id')
           ->whereIn('specialty',(array)$request->sections)->distinct()->get();
        foreach ($user_specialtyModel as  $key => $value_user_ids) {
         $users_ids_sections[]=$value_user_ids->user_id;
        }
      }
       $users_ids=array_merge($users_ids,$users_ids_sections);

      if($request->countries){

      $user_countries= DB::table('users')
                          ->select('users.id')
                          ->join('cities', 'cities.id', '=', 'users.city')
                          ->join('countries', 'countries.id', '=', 'cities.country_id')
                          ->whereIn('countries.id',(array)$request->countries)
                         ->distinct()->get();

        foreach ($user_countries as  $key => $value_user_ids) {
         $users_ids_countries[]=$value_user_ids->id;
        }
       /* print_r($users_ids_countries);
        return;*/
// return $users_ids;
       }

     $users_ids=array_merge($users_ids,$users_ids_countries);
     $users_ids=array_unique($users_ids);


 if(!empty($users_ids)){
  $data_join = DB::table('users')
  ->join('user_specialty', 'users.id', '=', 'user_specialty.user_id')
    ->join('sections', 'sections.id', '=', 'user_specialty.specialty')

    ->join('cities', 'cities.id', '=', 'users.city')
    ->join('countries', 'countries.id', '=', 'cities.country_id')
    ->select('users.*','sections.name as s_name','cities.name as city_name','countries.name as country_name')
    ->groupBy('user_specialty.user_id')
    ->whereIn('users.id', $users_ids)
    ->get();
  }else{

    $data_join = DB::table('users')
    ->join('user_specialty', 'users.id', '=', 'user_specialty.user_id')
    ->join('sections', 'sections.id', '=', 'user_specialty.specialty')
    ->join('cities', 'cities.id', '=', 'users.city')
    ->join('countries', 'countries.id', '=', 'cities.country_id')
    ->select('users.*','sections.name as s_name','cities.name as city_name','countries.name as country_name')
    ->groupBy('user_specialty.user_id')
    ->get();
  }


/*
 echo "<pre>";
      print_r($users_ids);
      echo "</pre>";
      return;*/
      if($data_join){
        return response()->json(['code' => 200 , 'msg' => "success" , "data" => $data_join]);
      }else{
        return response()->json(['code' => 404 , 'msg' => "not found" ]);
      }

    }


public function lawyer($locale='ar',$id){

        $user_specialty = DB::table('user_specialty')
        ->where('user_id', '=', $id)
        ->orderBy('id')->get();

        $lawyer_data = User::findOrFail($id);

        $countLawyersCases = DB::table('bids')
            ->where('bids.user_id','=',$id)
            ->count();


        $lawyerCases = DB::table('cases')
            ->join('countries', 'countries.id', '=', 'cases.country')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->Leftjoin('bids','bids.case_id','=','cases.id')
            ->where('bids.user_id','=',$id)
            ->select('cases.*','countries.name as name1','cities.name as name2','bids.bids_val as bidValue')
            ->orderBy ('cases.created_at','desc')
            ->get();





        $country_id=$lawyer_data->country;
        $user_country = Countries::findOrFail($country_id);

        $city_id=$lawyer_data->city;
        $user_city = Cities::findOrFail($city_id);

        $birthdate= $lawyer_data->birthdate;
        $birthdate= strtotime($lawyer_data->birthdate);
        $birthdate= date("Y, m, d", $birthdate);
        $birthdate= (int)$birthdate;
        $birthdate_year=Carbon::createFromDate($birthdate)->diff(Carbon::now())->format('%y');
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.edit_admin'),
            'user_data'=>$lawyer_data,
            'user_specialty'=>$user_specialty,
            'user_country'=>$user_country,
            'user_city'=>$user_city,
            'countLawyersCases'=>$countLawyersCases,
            'birthdate_year'=>$birthdate_year,
            'lawyerCases'=>$lawyerCases,
        ];
        // return Carbon::createFromDate(1991, 7, 19)->diff(Carbon::now())->format('%y years, %m months and %d days');

          return view(FE.'.lawyer')->with($data);
      }
}
