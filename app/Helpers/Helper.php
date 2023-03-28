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
?>
