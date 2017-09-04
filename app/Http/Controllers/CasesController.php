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
      /*
      $sess_user_id= session('user_id');
      $sess_locale= session('sess_locale');
        echo $sess_locale;
      return $sess_user_id;
      */
        //
    // return   auth()->user()->id;
//session(['user_id' => $user_id]);
        return view(FE . '/v_add_case');
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



public function test (Request $request)


    {
         $sess_user_id= session('user_id');

        $rules=[
            'title'                           =>'required',
            'description'                     =>'required',
            'type'                            =>'required',
            'country'                         =>'required',
            'finished_date'                   =>'required',
           
         
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'title'                     =>'title',
            'description'               =>'description',
            'type'                      =>'type',
            'country'                   =>'country',
           'finished_date'              =>'finished_date',
      
        ]);
        if($validator->fails())
        {
            session()->flash('error_msg', trans('cpanel.form_error'));


            // return $request->all();
            return back()->withInput()->withErrors($validator);
        }else{

            $add = new Cases;
           // $add->id                    =date('YmdHis') . mt_rand();
            $add->id                       =uniqid('',true);
            $add->title                    = $request->input('title');
            $add->description              = $request->input('description');
           
            $add->type                     = $request->input('type');
            $add->country                  = $request->input('country');
        
            $add->finished_date            = $request->input('finished_date');
            $add->user_id                  = $sess_user_id;
            $add->status                   = 1;
            $add->save();
         

                Session::flash('message', 'تم اضافة قضيتك بنجاح'); 
              Session::flash('alert-class', 'alert-success'); 
           $sess_locale=$request->session()->get('sess_locale');
            return redirect($sess_locale.'/show');
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

        /*  if(auth()->user()->id != $id){
              return redirect('/');
          }*/
       //   if(auth()->user()->id == user_id)

         $cases_data = Cases::findOrFail($id);
      
          $data = [
              
               'title'=>trans('cpanel.site_name'),
              'page_title'=>trans('cpanel.edit_admin'),
              'submit_button'=>trans('cpanel.save'),
              'cases_data'=>$cases_data,
              'type'=>'edit',
              'form_title'=>trans('cpanel.admin_form'),
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
            
           
         
        ];
      
          $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
              'title'                     =>'title',
        
          ]);
          if($validator->fails())
          {
           // return $request->all();
              session()->flash('error_msg', 'form_error');
              return back()->withInput()->withErrors($validator);
          }else{
              $case = Cases::findOrFail($id);

            $case->title                    = $request->input('title');
            // $case->description             = $request->input('description');
           
            // $case->type                    = $request->input('type');
            // $case->country                 = $request->input('country');
        
            // $case->finished_date           =$request->input('finished_date');
            
            $case->status            = 1;


              $case->save();

          
             // session()->flash('success_msg', trans('cpanel.form_success'));
   Session::flash('message', 'تم تعديل قضيتك بنجاح'); 
             Session::flash('alert-class', 'alert-success'); 
           $sess_locale=$request->session()->get('sess_locale');
            
              return redirect($sess_locale.'/edit-case/'.$id);
          }
    }

public function dlt(Request $request){
  Cases::destroy($id);
  return back();
}


      public function AllCases(){
        $per_page = 2;
        $all_cases =  DB::table('cases')
               ->where('status', '=', '1')
              ->paginate($per_page);
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.edit_admin'),
            'per_page'=>$per_page,
            'all_cases'=>$all_cases,
        ];
          return view(FE . '/v_all_cases')->with($data);
      }
      public function YourCases(){

        $sess_user_id= session('user_id');
        $per_page = 2;
        $your_case =  DB::table('cases')
               ->where('status', '=', '1')
               ->where('user_id', '=', $sess_user_id)
              ->paginate($per_page);
        $data = [
            'title'=>trans('cpanel.site_name'),
            'page_title'=>trans('cpanel.edit_admin'),
            'per_page'=>$per_page,
            'your_case'=>$your_case,
        ];
          return view(FE . '/v_your_case')->with($data);
      }

   public function SingleCase($locale='ar',$id){
        
         /* $all_cases =  DB::table('cases')
               ->where('status', '=', '1');*/
        $case = Cases::findOrFail($id);
        $user_id=$case->user_id;
        $user_case = User::findOrFail($user_id);
         

        $data = [
            'title'=>trans('cpanel.site_name'), 
            'case'=>$case,
            'id'=>$id,
            'user_case'=>$user_case,
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
}
