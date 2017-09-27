<?php

namespace App\Http\Controllers\Frontend;

use App\bids;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use App\Http\Requests;
use Session;
use Auth;
use App\User;
use Carbon\Carbon;
use DB;
use Response;
use File;

class BidsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bids  $bids
     * @return \Illuminate\Http\Response
     */
    public function show(bids $bids)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bids  $bids
     * @return \Illuminate\Http\Response
     */
    public function edit(bids $bids)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bids  $bids
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bids $bids)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bids  $bids
     * @return \Illuminate\Http\Response
     */
    public function destroy(bids $bids)
    {
        //
    }

    public function set_your_bids(Request $request, $id){
      // return $request->all();
      $bids_val= $request->input('bids_val');
      $case_id= $request->input('case_id');

      $sess_user_id= session('user_id');
      $add = new bids;
      $add->id         =abs( crc32( uniqid() ) );
      $add->user_id    =$sess_user_id;
      $add->case_id    =$case_id;
      $add->bids_val    =$bids_val;
      $add->save();
      $sess_locale=$request->session()->get('sess_locale');

        // return redirect($sess_locale.'/case/'.$case_id);
      $data = [
          'bids_val' => $bids_val,
      ];

      return response($data, 200)->header('Content-Type', 'text/plain');
    }

    public function apply_bids(Request $request){
      // return $request->all();
      $user_bids_id= $request->input('user_bids_id');
      $case_id= $request->input('case_id');

      $AcceptOffer =  DB::table('bids')
               ->where('bids.user_id','=', $user_bids_id)
               ->where('bids.case_id','=',$case_id)
               ->update(array('is_pids'=> 1));

    $AcceptOfferCase =  DB::table('cases')
               ->where('cases.id','=',$case_id)
               ->update(array('status'=> 2));

        // return redirect($sess_locale.'/case/'.$case_id);
      $data = [
          'msg' => 'success',
      ];

      return response($data, 200)->header('Content-Type', 'text/plain');
    }

}
