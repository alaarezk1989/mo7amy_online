<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests;
use Validator;
use Auth;
use App\User;
use Hash;
use Mail;
use CountryState;
use App;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
     $url_segment = \Request::segment(1);
     if($url_segment=='ar' || $url_segment=='en'){
       App::setLocale($url_segment);
       $locale = App::getLocale();
     }else{
       App::setLocale('ar');
       $locale = App::getLocale();
     }

     session(['sess_locale' => $locale]);
     $sess_locale= session('sess_locale');

   }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale='ar')
    {
      App::setLocale($locale);
      $locale = App::getLocale();

      // $countries = CountryState::getCountries();

      $all_countries = DB::table('countries')
      ->where('local', '=', $locale)->orderBy('id')->get();
      $first_country_id=0;
      $countries=array();
      foreach ($all_countries as $country) {
        if($first_country_id <= 0){
          $first_country_id=$country->id;
        }
        // if($country->id < $first_country_id){
        //     $first_country_id=$country->id;
        // }
        $countries[$country->id]=$country->name;
      }

      // $states = CountryState::getStates('EG');
      $states=array();
      $all_states = DB::table('cities')
      ->where('local', '=', $locale)
      ->where('country_id', '=', $first_country_id)
      ->get();
      foreach ($all_states as $state) {
        $states[$state->id]=$state->name;
      }

$latest_cases = $this->LatestCases();
      $data = [
          'title'=>trans('cpanel.site_name'),
          'countries'=>$countries,
          'states'=>$states,
          'locale'=>$locale,
          'latest_cases'=>$latest_cases,

      ];
        return view(FE . '/home')->with($data);
    }


    public function LatestCases(){

        $Latest_cases = DB::table('cases')
            ->join('countries', 'countries.id', '=', 'cases.country')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->select('cases.*')
            ->orderBy ('cases.created_at')
            ->limit(9)
            ->get();

       
          return $Latest_cases;

      }

}
