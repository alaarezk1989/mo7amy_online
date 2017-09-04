<?php

namespace App\Http\Controllers\Frontend;

use App\Cities;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests;
use Validator;
use Auth;
use App\User;
use App\User_specialty;
use App;
use Hash;
// use CountryState;
use DB;
use Response;
use File;

class CitiesController extends Controller
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
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function show(Cities $cities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit(Cities $cities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cities $cities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cities $cities)
    {
        //
    }

    function cities_country($country_id){

          $sess_locale= session('sess_locale');
        // $cities= DB::table('cities')
        // ->where('local', '=', $sess_locale)
        // ->where('country_id', '=', $country_id)
        // ->get();

        $cities = Cities::where('local', '=', $sess_locale)
        ->where('country_id', '=', $country_id)->get();

        $data = [
            'cities_data' => $cities,
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

}
