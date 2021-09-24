<?php


class Input
{
    //  İstek  var mı yok mu kontrol 
    public static function kontrol($tip = 'post')
    {
        switch (mb_strtolower($tip)) {
            case 'post':
                return (!empty($_POST)) ?  true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                break;
        }
    }
    //  Gelen değeri çekme
    public static function cek ($name){
        if(isset($_POST[$name])){
            return $_POST[$name];
        }
        else if(isset($_GET[$name])){
            return $_GET[$name];
        }
        else{
            return false;
        }

    }
}
