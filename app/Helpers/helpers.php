<?php

if (!function_exists('my_asset')) {
    function user_auth()
    {
         $sess_user_obj= session('user_obj');
         return $sess_user_obj;
    }
}


if (!function_exists('lang_url')) {
    function lang_url($path)
    {
      $locale = App::getLocale();
        return url($locale.'/'.$path);
    }
}
