<?php


class Input
{
    //  İstek  var mı yok mu kontrol 
    public static function exist($type = 'post')
    {
        switch (mb_strtolower($type)) {
            case 'post':
                return (!empty($_POST))  ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                break;
        }
    }
    //  Gelen değeri çekme
    public static function get($item)
    {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        } else {
            return false;
        }
    }
}
