<?php
    // class Helper{
        function auth_asset($path){
            $aa = "auth_assets/assets";
            return asset($aa.$path);
        }
    // }
    function admin_asset($path){
        $bb = "admin_assets/assets";
        return asset($bb.$path);
    }

    function user_asset($path){
        $cc = "user_assets/assets";
        return asset($cc.$path);
    }

    if (!function_exists('money')) {
        function money($value)
        {
            return '$' . number_format($value, 2);
        }
    }
?>
