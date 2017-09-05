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
use Carbon;


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

      // $states = CountryState::getStates('EG');
      // $countries = CountryState::getCountries();

      $latest_cases = $this->LatestCases();
      $data = [
          'title'=>trans('cpanel.site_name'),
          // 'countries'=>$countries,
          // 'states'=>$states,
          'locale'=>$locale,
          'latest_cases'=>$latest_cases,

      ];
        return view(FE . '/home')->with($data);
    }


    public function LatestCases(){

        $Latest_cases = DB::table('cases')
            ->join('countries', 'countries.id', '=', 'cases.country')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->select('cases.*','countries.name as name1','cities.name as name2')
            ->orderBy ('cases.created_at')
            ->limit(9)
            ->get();


          return $Latest_cases;

      }

}
