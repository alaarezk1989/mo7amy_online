<?php

if (!function_exists('my_asset')) {
    function my_asset($path)
    {
        return asset($path, 'alaa');
    }
}


if (!function_exists('lang_url')) {
    function lang_url($path)
    {
      $locale = App::getLocale();
        return url($locale.'/'.$path);
    }
}
