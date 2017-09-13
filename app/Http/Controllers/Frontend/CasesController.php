<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Validator;
use App\Cases;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

/*sections*/
        $sess_locale= session('sess_locale');
      $all_sections = DB::table('sections')
          ->where('local', '=', $sess_locale)->orderBy('id')->get();
          $first_section_id=0;
          $countries=array();
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
          $states=array();
          $all_states = DB::table('cities')
         ->where('local', '=', $sess_locale)
         ->where('country_id', '=', $first_country_id)
          ->get();
          foreach ($all_states as $state) {
            $states[$state->id]=$state->name;
          }
 //$specialty  = User::GetAdminSpecialty();
 $sess_user_id= session('user_id');
        $data = [
              'title'=>trans('cpanel.site_name'),
              'page_title'=>trans('cpanel.edit_admin'),
              'submit_button'=>trans('cpanel.save'),
              'type'=>'edit',
              'form_title'=>trans('cpanel.admin_form'),
              'sections'=>$sections,
              'countries'=>$countries,
              'states'=>$states,
              'sess_user_id'=>$sess_user_id,
          ];
        return view(FE . '/cases_forms')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

public function create_case (Request $request)
    {
         $sess_user_id= session('user_id');
        $rules=[
            'title'                           =>'required',
            'description'                     =>'required',
            'section_id'                      =>'required',
            'country'                         =>'required',
            'city'                            =>'required',
            'finished_date'                   =>'required|date_format:Y-m-d|after:tomorrow',


        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'title'                     =>'title',
            'description'               =>'description',
            'section_id'                      =>'section_id',
            'country'                   =>'country',
            'city'                      =>'city',
           'finished_date'              =>'finished date',

        ]);
        if($validator->fails())
        {   /*$errors = $validation->messages();
          echo $errors;
          return;*/
            session()->flash('error_msg', trans('cpanel.form_error'));
            // return $request->all();
            return back()->withInput()->withErrors($validator);
        }else{

            $add = new Cases;
           // $add->id                    =date('YmdHis') . mt_rand();
            $add->id                       =uniqid('',true);
            $add->title                    = $request->input('title');
            $add->description              = $request->input('description');

            $add->section_id               = $request->input('section_id');
            $add->country                  = $request->input('country');
            $add->city                     = $request->input('city');
            $add->finished_date            = $request->input('finished_date');
            $add->user_id                  = $sess_user_id;
            $add->status                   = 1;
            $add->save();

                Session::flash('message', 'تم اضافة قضيتك بنجاح');
              Session::flash('alert-class', 'alert-success');
           $sess_locale=$request->session()->get('sess_locale');
            return redirect($sess_locale.'/create');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($locale='ar',$id)
    {


/*sections*/
        $sess_locale= session('sess_locale');
      $all_sections = DB::table('sections')
          ->where('local', '=', $sess_locale)->orderBy('id')->get();
          $first_section_id=0;
          $countries=array();
          foreach ($all_sections as $section) {
            if($first_section_id <= 0){
              $first_section_id=$section->id;
            }

            $sections[$section->id]=$section->name;
          }
/*sections*/


      $sess_locale= session('sess_locale');

 //$specialty  = User::GetAdminSpecialty();
 $sess_user_id= session('user_id');
         $cases_data = Cases::findOrFail($id);

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
          $states=array();
          $all_states = DB::table('cities')
         ->where('local', '=', $sess_locale)
         ->where('country_id', '=', $cases_data->country)
          ->get();
          foreach ($all_states as $state) {
            $states[$state->id]=$state->name;
          }

          $data = [
               'title'=>trans('cpanel.site_name'),
              'page_title'=>trans('cpanel.edit_admin'),
              'submit_button'=>trans('cpanel.save'),
              'type'=>'edit',
              'form_title'=>trans('cpanel.admin_form'),
              'sections'=>$sections,
              'countries'=>$countries,
              'states'=>$states,
              'sess_user_id'=>$sess_user_id,
              'cases_data'=>$cases_data,
              'id'=>$id,
          ];
          return view(FE.'.cases_forms')->with($data);
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
        //return $id;
        $rules=[
            'title'                           =>'required',
            'description'                     =>'required',
            'section_id'                      =>'required',
            'country'                         =>'required',
            'city'                            =>'required',
            'finished_date'                   =>'required|date_format:Y-m-d|after:tomorrow',




        ];

          $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'title'                     =>'title',
            'description'               =>'description',
            'section_id'                =>'section_id',
            'country'                   =>'country',
            'city'                      =>'city',
           'finished_date'              =>'finished_date',

          ]);
          if($validator->fails())
          {
           // return $request->all();
              session()->flash('error_msg', 'form_error');
              return back()->withInput()->withErrors($validator);
          }else{
              $case = Cases::findOrFail($id);
            $case->title                   = $request->input('title');
            $case->description             = $request->input('description');
            $case->section_id              = $request->input('section_id');
            $case->country                 = $request->input('country');
            $case->city                    = $request->input('city');
            $case->finished_date           =$request->input('finished_date');
            $case->status                  = 1;
            $case->save();

             // session()->flash('success_msg', trans('cpanel.form_success'));
             Session::flash('message', 'تم تعديل قضيتك بنجاح');
             Session::flash('alert-class', 'alert-success');
             $sess_locale=$request->session()->get('sess_locale');

              return redirect($sess_locale.'/edit-case/'.$id);
          }
    }
   public function delete($locale='ar',$id)
    {
       /*echo $id;
       return;*/
        $case = Cases::findOrFail($id);
        $case->delete();

         Session::flash('message', 'تم مسح قضيتك بنجاح');
              Session::flash('alert-class', 'alert-success');
           $sess_locale= session('sess_locale');
            return redirect($sess_locale.'/your-cases');
    }
      public function AllCases(){


              $per_page = 20;
              $all_cases =  DB::table('cases')
                ->where('status', '=', '1')

                ->join('countries', 'countries.id', '=', 'cases.country')
                ->join('cities', 'cities.id', '=', 'cases.city')
                ->select('cases.*','countries.name as name1','cities.name as name2')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);


                /*sections*/
<<<<<<< HEAD

                
        
          $all_sections = DB::table('sections')
          ->select($locale.'_name','id')
          ->orderBy('id')->get();
          // print_r($all_sections);
          // return;
=======
        $sess_locale= session('sess_locale');
      $all_sections = DB::table('sections')
          ->where('local', '=', $sess_locale)->orderBy('id')->get();
>>>>>>> 83704b36da75e67de775613242f71b1c209ebc3d
          $first_section_id=0;
          $sections=array();
          foreach ($all_sections as $section) {
            if($first_section_id <= 0){
              $first_section_id=$section->id;
            }

            $sections[$section->id]=$section->name;
          }
/*sections*/

       //$specialty = User::GetAdminSpecialty();
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
/*echo "<pre>";
print_r($specialty);
echo "</pre>";
return; */
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.edit_admin'),
            'per_page'=>$per_page,
            'sections'=>$sections,
            'countries'=>$countries,
            'all_cases'=>$all_cases,
            // 'finished_days'=>$finished_days,
        ];
          return view(FE . '/v_all_cases')->with($data);
      }
      public function your_cases(){
        $sess_user_id= session('user_id');
        $per_page = 10;
  

      $your_case =  DB::table('cases')
                ->where('status', '=', '1')
                ->where('user_id', '=', $sess_user_id)
                ->join('countries', 'countries.id', '=', 'cases.country')
                ->join('cities', 'cities.id', '=', 'cases.city')
                ->join('sections', 'sections.id', '=', 'cases.section_id')
->select('cases.*','countries.name as name1','cities.name as name2','sections.name as sectionName')
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);




      /* echo "<pre>";
      print_r($cases);
      echo "</pre>";
      return;*/
    



        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.edit_admin'),
            'per_page'=>$per_page,
            'your_case'=>$your_case,
        ];
          return view(FE . '/v_your_case')->with($data);
      }
   public function SingleCase($locale='ar',$id){

$case_bids=array();
$all_case_bids=array();

     if(auth()->user()){
        $sess_user_id= session('user_id');
        $case_bids =  DB::table('bids')
         ->where('user_id', '=', $sess_user_id)
         ->where('case_id', '=', $id)->first();

         $per_page = 25;
        /* $all_case_bids=DB::table('bids')
          ->where('case_id', '=', $id)
          ->orderBy('created_at', 'desc')
          ->paginate($per_page);
*/
          $all_case_bids = DB::table('bids')
              ->where('case_id', '=', $id)
              ->join('users', 'users.id', '=', 'bids.user_id')
              ->join('countries', 'countries.id', '=', 'users.country')
              ->join('cities', 'cities.id', '=', 'users.city')
              ->select('bids.*','users.*','countries.name as country_name','cities.name as city_name')
              ->orderBy ('bids.created_at')
              ->limit($per_page)
              ->get();
      }
// return $all_case_bids;
        $case = Cases::findOrFail($id);
           /* echo "<pre>";
      print_r($case);
      echo "</pre>";
      return;*/
        $user_id=$case->user_id;
        $user_case = User::findOrFail($user_id);

        $data = [
            'title'=>trans('cpanel.site_name'),
            'case'=>$case,
            'id'=>$id,
            'user_case'=>$user_case,
            'case_bids'=>$case_bids,
            'all_case_bids'=>$all_case_bids,
        ];
      /*echo "<pre>";
      print_r($data);
      echo "</pre>";
      return;*/
          return view(FE . '/v_single_case')->with($data);
      }

    public function store(Request $request)
    {
        //
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

   /* public function filtering(Request $request){

      if($request->types AND $request->countries){
        //$cases = Cases::where('country' ,'=', $request->countries)->get();
        $cases = Cases::whereIn('type', (array)$request->types)
        ->whereIn('country', (array)$request->countries)
        ->get();
      }elseif($request->types AND !$request->countries){
        $cases = Cases::whereIn('type', (array)$request->types)->get();
      }elseif($request->countries AND !$request->types){
        $cases = Cases::whereIn('country' , (array)$request->countries)->get();
      }else{
        $cases = Cases::get();
      }

      //return response()->json(['types' => $request->types , 'countries' => $request->countries]);
        
      if($cases){
        return response()->json(['code' => 200 , 'msg' => "success" , "data" => $cases]);
      }else{
        return response()->json(['code' => 404 , 'msg' => "not found" ]);
      }
      


    }*/


   public function filtering(Request $request){

      $caseModel = DB::table('cases');
    

      if($request->sections){
        $caseModel->whereIn('section_id', (array)$request->sections);
      } 
      if($request->countries){
        $c_array=(array)$request->countries;
         $c_array=array_unique($c_array);
        $caseModel->whereIn('country', $c_array);
      }
      if($request->status){
        $caseModel->whereIn('status', (array)$request->status);
      }

       if($request->created_date){
        $new_time = date("Y-m-d H:i:s", strtotime('-1 hours'));
        $caseModel->where('created_dte','>=', $new_time);
      }

      $cases = $caseModel->join('countries', function ($join) {
        $join->on('cases.country', '=', 'countries.id');

      })->join('cities', function ($join) {
        $join->on('cases.city', '=', 'cities.id');

      })->join('sections', function ($join) {
        $join->on('cases.section_id', '=', 'sections.id');
        
    })->select('cases.*', 'countries.name as CountryName', 'cities.name as Cityname', 'sections.name as SectionName')->get();


      if($cases){
        return response()->json(['code' => 200 , 'msg' => "success" , "data" => $cases]);
      }else{
        return response()->json(['code' => 404 , 'msg' => "not found" ]);
      }
      
    }
}
