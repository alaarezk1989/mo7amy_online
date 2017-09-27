<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use App;
use DB;

class User extends Authenticatable
{
    use Notifiable;
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_specialty()
       {
           return $this->belongsToMany('App\User_specialty');
       }
    public function scopeGetAdminTypes()
    {
        $types = [
        'admin'     => trans('cpanel.admin'),
        'lawyer'    => trans('cpanel.lawyer'),
        'client'    => trans('cpanel.client'),
        ];
        return $types;
    }

    public function scopeGetAdminSpecialty()
    {
            $locale = App::getLocale();
            $locale_name=$locale.'_name';
         $specialty_query = DB::table('sections')
        ->get();
        foreach ($specialty_query as $value) {
          $specialty[$value->id]=$value->$locale_name;
        }
        return $specialty;
    }



    /**
    * @return user role
    **/
    public function scopeGetRole()
    {
      // return auth()->user()->permissions;
        return user_auth()->permissions;
    }

    public function scopeGetid()
    {
        return auth()->user()->id;
    }

    /**
    * compare user role ans given role
    * @param userRole, role
    * @return user role
    **/
    static function hasRole($role)
    {
        if(auth()->user()->permissions == $role)
        {
            return true;
        }else{
            return false;
        }
    }

    public function sendPasswordResetNotification($token)
   {
       $this->notify(new CustomPassword($token));
   }
}



class CustomPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('mo7amy online We are sending this email because we recieved a forgot password request.')
            ->action('Reset Password', url(config('app.url') . route('password.reset', $this->token, false)))
            ->line('If you did not request a password reset, no further action is required. Please contact us if you did not submit this request.');
    }
}
