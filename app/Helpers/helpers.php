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



if (!function_exists('get_countries_cities')) {
    function get_countries_cities()
    {
      $locale = App::getLocale();

      $all_countries = DB::table('countries')
         ->select($locale.'_name','id')
         ->orderBy('id')->get();
         $first_country_id=0;
         $countries=array();

         $locale_name=$locale.'_name';
         foreach ($all_countries as $country) {
           if($first_country_id <= 0){
             $first_country_id=$country->id;
           }
           $countries[$country->id]=$country->$locale_name;
         }



      $states=array();
      $all_states = DB::table('cities')
      ->select($locale.'_name','id')
     ->where('country_id', '=', $first_country_id)
      ->get();
      foreach ($all_states as $state) {
        $states[$state->id]=$state->$locale_name;
      }


        $data=[
          'countries'=>$countries,
          'states'=>$states,
      ];
      return $data;
    }
}

if (!function_exists('pr')) {
    function pr($data)
    {
      echo "<pre>\n";
          print_r($data, true);
      echo "</pre>\n";
    }
}
