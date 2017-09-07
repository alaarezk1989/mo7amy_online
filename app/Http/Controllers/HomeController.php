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


    public function LatestCases(){

        $Latest_cases = DB::table('cases')
            ->join('countries', 'countries.id', '=', 'cases.country')
            ->join('cities', 'cities.id', '=', 'cases.city')
            ->select('cases.*','countries.name as name1','cities.name as name2')
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
            ->where('country','=','1','or','6')
             ->count();
             return $egyptCases;

      }

      public function saudiCases(){

        $saudiCases = DB::table('cases')
            ->where('country','=','2','or','7')
             ->count();
             return $saudiCases;

      }

      public function algeriaCases(){

        $algeriaCases = DB::table('cases')
            ->where('country','=','5','or','10')
             ->count();
             return $algeriaCases;

      }

      public function tunisiaCases(){

        $tunisiaCases = DB::table('cases')
            ->where('country','=','3','or','8')
             ->count();
             return $tunisiaCases;

      }

      public function libyaCases(){

        $libyaCases = DB::table('cases')
            ->where('country','=','4','or','9')
             ->count();
             return $libyaCases;

      }

}
