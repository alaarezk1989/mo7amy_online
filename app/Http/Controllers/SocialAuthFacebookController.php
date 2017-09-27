<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Socialite;
use App\User;
use App;
use DB;
use Session;
class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
  /*  public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
*/
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
     /*
    public function callback()
    {

    }*/



    protected $redirectPath = '/ar';

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('ar/auth/facebook');
        }

        $authUser = $this->findOrCreateUser($user);

        // Auth::login($authUser, true);
        if($authUser->id >0){
          $user_id=$authUser->id;
          session(['user_id' => $user_id]);
        }
        $user_id=session('user_id');
        Auth::loginUsingId($user_id);

        $user_obj = DB::table('users')
        ->where('id', '=', $user_id)->first();
        session(['user_obj' => $user_obj]);

        $sess_locale= session('sess_locale');

        return redirect($sess_locale.'/edit-profile/'.$user_id);
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('facebook_id', $facebookUser->id)->first();

        if ($authUser){
            return $authUser;
        }

        $user_id=abs( crc32( uniqid() ) );
       session(['user_id' => $user_id]);


        $add = new User;
        $add->id                      =$user_id;
        $add->name                    =  $facebookUser->name;
        $add->email                   = $facebookUser->email;
        $add->facebook_id                = $facebookUser->id;
        $add->status                  = 1;
        $add->permissions             = 'lawyer';
        $add->save();

        return $add;

/*
        return User::create([
            'id'   =>$user_id,
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'facebook_id' => $facebookUser->id,
            'status'=>1,
            'permissions'=>'lawyer'
        ]);*/
    }


}
