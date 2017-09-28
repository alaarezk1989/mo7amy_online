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
use File;
use Illuminate\Support\Facades\Input;


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
              'city'                      =>'required',
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
              'city'                      =>'city',

          ]);
          if($validator->fails())
          {
              Session::flash('error_msg',  trans('cpanel.form_error'));
              Session::flash('alert-class', 'alert-danger');

                 // return $request->all();
              // return back()->withInput()->withErrors($validator);
              return redirect('/#sign')->withInput()->withErrors($validator);
          }else{
             // return $request->all();
            $user_id=abs( crc32( uniqid() ) );
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
              $user_obj = DB::table('users')
            ->where('id', '=', $user_id)->first();

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
          $user_country_id=array();

        $user_country_id =  DB::table('users')
          ->join('cities', 'cities.id', '=', 'users.city')
          ->join('countries', 'countries.id', '=', 'cities.country_id')
          ->select('countries.*')
           ->where('users.id', '=', $sess_user_id)
          ->first();

          if($user_country_id){
              $selected_user_country_id=$user_country_id->id;

            $all_states =  DB::table('users')
              ->join('cities', 'cities.id', '=', 'users.city')
              ->join('countries', 'countries.id', '=', 'cities.country_id')
              ->select('cities.*')
               ->where('countries.id', '=',$selected_user_country_id)
              ->get();

            foreach ($all_states as $state) {
              $states[$state->id]=$state->$locale_name;
            }
          }else{
            $selected_user_country_id=0;
          }


          $types  = User::GetAdminTypes();
          $specialty  = User::GetAdminSpecialty();
          // if(User::GetRole() == 'admin')

          $user_specialty  = user_specialty::where('user_id', '=', $id)->get();
          $selected_user_specialty = [];
          if(!empty($user_specialty)){
            foreach( $user_specialty as $sp )
            {
                $selected_user_specialty[$sp->specialty] = $sp->specialty;
            }
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
              'user_country_id'=>$selected_user_country_id,
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
            'birthdate'                     =>'required|before:20 years ago',

          ];


          $messages = [
        'birthdate.before' => 'You must be at least 20 years old',
    ];

          // Check if He/She want to change password
          if(!empty($request->input('password')) && $request->input('password')!= null)
          {
              $rules['password']='min:8|confirmed';
              $rules['password_confirmation']='min:8';
          }

          $validator = Validator::make($request->all(), $rules, $messages);
          $validator->SetAttributeNames([
            'name'                      =>trans('cpanel.name'),
            'password'                  =>trans('cpanel.password'),
            'password_confirmation'     =>trans('cpanel.password_confirmation'),
            'phone'                     =>trans('cpanel.phone'),
            'birthdate'                 =>'birthdate',
          ]);
          if($validator->fails())
          {

              Session::flash('error_msg',  trans('cpanel.form_error'));
              Session::flash('alert-class', 'alert-danger');
              return back()->withInput()->withErrors($validator);
          }else{
              $sess_user_id= session('user_id');
              $edit = User::findOrFail($id);

              if (!empty($request->file('profile_picture'))) {
                $date_path=date("Y").'/'.date("m").'/';
                $path = public_path() . '/uploads/user_img/'.$date_path;

                if(!File::exists($path)) {
                   File::makeDirectory($path, 0777, true);
                  //  $result = File::makeDirectory($path, 0775, true, true);

                 }
                  $file_name = date('YmdHis') . mt_rand() . '_user_img.' . $request->file('profile_picture')->getClientOriginalExtension();

                  if ($request->file('profile_picture')->move($path, $file_name)) {
                      $img = $date_path.$file_name;
                      $edit->image                   = $img;


                  }
              } else {
                //  $img = '';
              }

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
              $edit->save();

              if(!empty($request->input('specialty'))){
                  User_specialty::where('user_id', '=', $id)->delete();

                  $specialty=$request->input('specialty');
                foreach ($specialty as $key => $specialty_value) {
                  $add = new User_specialty;
                  $add->id         =abs( crc32( uniqid() ) );
                  $add->user_id    =$id;
                  $add->specialty    =$specialty_value;
                  $add->save();
                }
              }
              // session()->flash('success_msg', trans('cpanel.form_success'));
              Session::flash('message',  trans('cpanel.form_success'));
              Session::flash('alert-class', 'alert-success');
            $sess_locale=$request->session()->get('sess_locale');

            $user_obj = DB::table('users')
            ->where('id', '=', $id)->first();
            session(['user_obj' => $user_obj]);
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
        $per_page = 3;
        $specialty  = User::GetAdminSpecialty();


          $sess_locale= session('sess_locale');
          $locale_name=$sess_locale.'_name';


         $all_sections = DB::table('sections')
          ->select($sess_locale.'_name','id')->orderBy('id')->get();
          $first_section_id=0;
          $sections=array();
          foreach ($all_sections as $section) {
            if($first_section_id <= 0){
              $first_section_id=$section->id;
            }

            $sections[$section->id]=$section->$locale_name;
          }
/*sections*/


        $sess_locale= session('sess_locale');
       $all_countries = DB::table('countries')
          ->select($sess_locale.'_name','id')->orderBy('id')->get();
          $first_country_id=0;
          $countries=array();
          foreach ($all_countries as $country) {
            if($first_country_id <= 0){
              $first_country_id=$country->id;
            }

            $countries[$country->id]=$country->$locale_name;
          }

       // $per_page = 8;

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




   public function filtering(Request $request){
     $sess_locale= session('sess_locale');
    $per_page = 3;
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
        if(!empty($users_ids)){
        $users_ids=array_intersect($users_ids,$users_ids_countries);
        }else{
        $users_ids=array_merge($users_ids,$users_ids_countries);
        $users_ids=array_unique($users_ids);
      }
    }

  $data_join1 = DB::table('users')
  ->join('user_specialty', 'users.id', '=', 'user_specialty.user_id')
    ->join('sections', 'sections.id', '=', 'user_specialty.specialty')

    ->join('cities', 'cities.id', '=', 'users.city')
    ->join('countries', 'countries.id', '=', 'cities.country_id')
    ->groupBy('user_specialty.user_id');

    if($request->sortBy == 'max'){
    $data_join1->orderBy('users.name','desc');
       }
  elseif($request->sortBy == 'low'){
              $data_join1->orderBy('users.name','asc');
            }
   // if($request->sections || $request->countries){
   if(!empty($users_ids)){
    $data_join1->whereIn('users.id', $users_ids);
  }
    $data_join = $data_join1->select('users.*','sections.'.$sess_locale.'_name as s_name','cities.'.$sess_locale.'_name as city_name','countries.'.$sess_locale.'_name as country_name')

    ->paginate($per_page);

  // }else{

  //   $data_join = DB::table('users')
  //   ->join('user_specialty', 'users.id', '=', 'user_specialty.user_id')
  //   ->join('sections', 'sections.id', '=', 'user_specialty.specialty')
  //   ->join('cities', 'cities.id', '=', 'users.city')
  //   ->join('countries', 'countries.id', '=', 'cities.country_id')
  //   ->select('users.*','sections.'.$sess_locale.'_name as s_name','cities.'.$sess_locale.'_name as city_name','countries.'.$sess_locale.'_name as country_name')
  //   ->groupBy('user_specialty.user_id')
  //   // ->orderBy('users.name','desc')
  //   ->paginate($per_page);
  //   //->get();

  // }


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

        App::setLocale($locale);
        $locale = App::getLocale();


        $sess_user_id= session('user_id');
        $show_lowyer_contact_flag=0;
        //$lawyer_data = User::findOrFail($id);

        $lawyer_data = DB::table('users')
          ->join('cities', 'cities.id', '=', 'users.city')
          ->join('countries', 'countries.id', '=', 'cities.country_id')
          ->select('users.*','cities.'.$locale.'_name as city_name','countries.'.$locale.'_name as country_name')
          ->where('users.id','=', $id)
          ->first();

// print_r($lawyer_data->birthdate);return;
        $user_specialty = DB::table('user_specialty')
          ->join('sections', 'sections.id', '=', 'user_specialty.specialty')
          ->select('sections.'.$locale.'_name as s_name')
          ->where('user_specialty.user_id','=',$id)
          ->get();

         $birthdate= $lawyer_data->birthdate;
         $birthdate= strtotime($lawyer_data->birthdate);
         $birthdate= date("Y, m, d", $birthdate);
         $birthdate= (int)$birthdate;
         $birthdate_year=Carbon::createFromDate($birthdate)->diff(Carbon::now())->format('%y');

        $countLawyersCases = DB::table('bids')
            ->where('bids.user_id','=',$id)
            ->count();
          $per_page = 1;
        $lawyerCases = DB::table('cases')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->join('sections', 'sections.id', '=', 'cases.section_id')
           ->leftJoin('bids as bb','bb.case_id','=','cases.id')
           
           ->where('bb.user_id','=',$id)
  ->leftJoin(\DB::raw('(SELECT bids_val as m_bids ,case_id FROM bids as A WHERE A.bids_val = (SELECT MAX(bids_val) AS bidValue FROM bids B WHERE A.case_id=B.case_id)) AS t2'), function($join) {
               $join->on('cases.id', '=', 't2.case_id');
  })
            ->select('cases.*','bb.bids_val as bid_value','countries.'.$locale.'_name as name1','cities.'.$locale.'_name as name2','m_bids as max_bid_value','sections.'.$locale.'_name as sectionName')
           // ->orderBy ('cases.created_at','desc')
            ->paginate($per_page);
// print_r($lawyerCases);
// return;
foreach ($lawyerCases as $caser_row) {
  if($caser_row->status==2 && $caser_row->user_id==$sess_user_id){
    $show_lowyer_contact_flag=1;
    break;
  }

}
// print_r($lawyerCases);return;
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.edit_admin'),
            'user_data'=>$lawyer_data,
            'user_specialty'=>$user_specialty,
            'user_country'=>$lawyer_data->country_name,
            'user_city'=>$lawyer_data->city_name,
            'countLawyersCases'=>$countLawyersCases,
            'birthdate_year'=>$birthdate_year,
            'lawyerCases'=>$lawyerCases,
            'per_page'=>$per_page,
            'show_lowyer_contact_flag'=>$show_lowyer_contact_flag,
        ];
        // return Carbon::createFromDate(1991, 7, 19)->diff(Carbon::now())->format('%y years, %m months and %d days');

          return view(FE.'.lawyer')->with($data);
      }






public function lawyer_cases_filtering(Request $request,$locale='ar',$id){
  // return $id;
              App::setLocale($locale);
              $locale = App::getLocale();

              $per_page = 1;

 /* $lawyerCases = DB::table('cases')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->join('sections', 'sections.id', '=', 'cases.section_id')
            ->Leftjoin('bids','bids.case_id','=','cases.id')
            ->where('bids.user_id','=',$id)
            ->select('cases.*','countries.'.$locale.'_name as name1','cities.'.$locale.'_name as name2','bids.bids_val as bidValue','sections.'.$locale.'_name as sectionName')
            ->orderBy ('cases.created_at','desc')
            ->paginate($per_page);*/



              $Cases1 =   DB::table('cases')          
                ->join('cities', 'cities.id', '=', 'cases.city')
                ->join('countries', 'countries.id', '=', 'cities.country_id')
                ->join('sections', 'sections.id', '=', 'cases.section_id')

              //   ->leftJoin('bids', function ($join) {
              //   $join->on('bids.case_id','=','cases.id');
              // });
   
    ->leftJoin('bids as bb','bb.case_id','=','cases.id')
           
           ->where('bb.user_id','=',$id)
  ->leftJoin(\DB::raw('(SELECT bids_val as m_bids ,case_id FROM bids as A WHERE A.bids_val = (SELECT MAX(bids_val) AS bidValue FROM bids B WHERE A.case_id=B.case_id)) AS t2'), function($join) {
               $join->on('cases.id', '=', 't2.case_id');
  });
           
      

      if($request->sortBy == 'max'){
         $Cases1->orderBy('bids_val','desc');
      }elseif($request->sortBy == 'low'){
        $Cases1->orderBy('bids_val','asc');
      }elseif($request->sortBy == 'latest'){
        $Cases1->orderBy('cases.created_at','desc');
      }
      
                $cases = $Cases1 ->select('cases.*','bb.bids_val as bid_value','countries.'.$locale.'_name as name1','cities.'.$locale.'_name as name2','m_bids as max_bid_value','sections.'.$locale.'_name as sectionName')
           
               // ->where('bids.user_id','=',$id)
               ->paginate($per_page);
       /* echo "<pre>";
      print_r($cases);
      echo "</pre>";
      return;*/       // ->get();

    if($cases){
        return response()->json(['code' => 200 , 'msg' => "success" , "data" => $cases]);
      }else{
        return response()->json(['code' => 404 , 'msg' => "not found" ]);
      }


}









public function search(Request $request,$locale='ar'){

$q = $request->input('q');
    //$q =Input::get('q');
    $per_page = 4;
    $Users =  DB::table('users')
           ->where('name','LIKE','%'.$q.'%')->orWhere('career','LIKE','%'.$q.'%')
           ->where('permissions','=','lawyer')
          
           ->paginate($per_page);
           //->get();

  if(count($Users) > 0){
    return view(FE . '/v_lawyer_search')->withDetails($Users)->withQuery($q);
    }
  else{
    return view(FE . '/v_lawyer_search')->withMessage('لا يوجد نتيجة لبحثك من فضلك حاول مرة اخرى')->withQuery($q);
    }
}


public function searchFiltering(Request $request,$locale='ar'){

              App::setLocale($locale);
              $locale = App::getLocale();
              $q = $request->input('q');
              // $q =Input::get('q');
              $per_page=4;


     $Users1 =  DB::table('users')
            ->where('name','LIKE','%'.$q.'%')->orWhere('career','LIKE','%'.$q.'%')
            ->where('users.permissions','=','lawyer')
            ->join('user_specialty', 'users.id', '=', 'user_specialty.user_id')
            ->join('sections', 'sections.id', '=', 'user_specialty.specialty')

            ->join('cities', 'cities.id', '=', 'users.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->groupBy('user_specialty.user_id');
    if($request->sortBy == 'max'){
    $Users1->orderBy('users.name','desc');
  }elseif($request->sortBy == 'low'){
    $Users1->orderBy('users.name','asc');
  }

    $users = $Users1->select('users.*','users.name as username','users.career as usercareer')

    ->paginate($per_page);


    if($users){
        return response()->json(['code' => 200 , 'msg' => "success" , "data" => $users]);
      }else{
        return response()->json(['code' => 404 , 'msg' => "not found" ]);
      }


}



}
