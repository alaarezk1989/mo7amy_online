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
use Carbon\Carbon;


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
        // echo '<pre>';
        // print_r($latest_cases);
        // echo '</pre>';
        $lawyers = $this->lawyers();
        $countDoneCases = $this->countDoneCases();
        $countLawyers = $this->countLawyers();
        $countUsers = $this->countUsers();
        $countAllCases = $this->countAllCases();
        $libyaCases = $this->libyaCases();
        $tunisiaCases = $this->tunisiaCases();
        $algeriaCases = $this->algeriaCases();
        $saudiCases = $this->saudiCases();
        $egyptCases = $this->egyptCases();
      $data = [
          'title'=>trans('cpanel.site_name'),
          // 'countries'=>$countries,
          // 'states'=>$states,
          'locale'=>$locale,
          'latest_cases'=>$latest_cases,
          'lawyers'=>$lawyers,
          'countDoneCases'=>$countDoneCases,
          'countLawyers'=>$countLawyers,
          'countUsers'=>$countUsers,
          'countAllCases'=>$countAllCases,

          'libyaCases'=>$libyaCases,
          'tunisiaCases'=>$tunisiaCases,
          'algeriaCases'=>$algeriaCases,
          'saudiCases'=>$saudiCases,
          'egyptCases'=>$egyptCases,

      ];
        return view(FE . '/home')->with($data);
    }


    public function LatestCases($locale='ar'){
/*
        $Latest_cases = DB::table('cases')
            ->join('countries', 'countries.id', '=', 'cases.country')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->Leftjoin('bids','bids.case_id','=','cases.id')
            ->select('cases.*','countries.name as name1','cities.name as name2','bids.bids_val as bidValue')
            ->orderBy ('cases.created_at','desc')
            ->limit(9)
            ->get();*/
          
          $locale = App::getLocale();

          $Latest_cases = DB::table('cases')
            ->where('status', '=', '1')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->join('sections', 'sections.id', '=', 'cases.section_id')

               ->leftJoin(\DB::raw('(SELECT * FROM bids A WHERE bids_val = (SELECT MAX(bids_val) AS bidValue FROM bids B WHERE A.case_id=B.case_id)) AS t2'), function($join) {
               $join->on('cases.id', '=', 't2.case_id');

                  })
            ->select('cases.*','countries.'.$locale.'_name as name1','cities.'.$locale.'_name as name2','bids_val as bidValue','sections.'.$locale.'_name as sectionName')
            ->orderBy ('cases.created_at','desc')
            ->limit(9)
            ->get();

          return $Latest_cases;







      }



       public function countDoneCases(){

        $countDoneCases = DB::table('cases')           
            ->where('status','=','1')
            ->count();
          return $countDoneCases;

      }

      public function countAllCases(){

        $countAllCases = DB::table('cases')           
            ->count();
          return $countAllCases;

      }

      public function countLawyers(){

        $countLawyers = DB::table('users')           
            ->where('permissions','=','lawyer')
            ->count();
          return $countLawyers;

      }

      public function countUsers(){

        $countUsers = DB::table('users')           
            ->where('permissions','=','client')
            ->count();
          return $countUsers;

      }

      public function lawyers(){

        $lawyers = DB::table('users')
            ->select('users.*')
            ->where('permissions','=','lawyer')
            ->limit(6)
            ->get();


          return $lawyers;

      }


    public function egyptCases(){

        $egyptCases = DB::table('cases')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('cities.country_id','=','1')
             ->count();
             return $egyptCases;

      }

      public function saudiCases(){

        $saudiCases = DB::table('cases')
         ->join('cities', 'cities.id', '=', 'cases.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('cities.country_id','=','2')
             ->count();
             return $saudiCases;

      }

      public function algeriaCases(){

        $algeriaCases = DB::table('cases')
         ->join('cities', 'cities.id', '=', 'cases.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('cities.country_id','=','5')
             ->count();
             return $algeriaCases;

      }

      public function tunisiaCases(){

        $tunisiaCases = DB::table('cases')
         ->join('cities', 'cities.id', '=', 'cases.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('cities.country_id','=','3')
             ->count();
             return $tunisiaCases;

      }

      public function libyaCases(){

        $libyaCases = DB::table('cases')
         ->join('cities', 'cities.id', '=', 'cases.city')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('cities.country_id','=','4')
             ->count();
             return $libyaCases;

      }

}
