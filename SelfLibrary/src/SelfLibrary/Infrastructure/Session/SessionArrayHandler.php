<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 6/3/15
 * Time: 6:28 PM
 */

namespace SelfLibrary\Infrastructure\Session;


class SessionArrayHandler {
    public function read($key){
        return (isset($_SESSION[$key]) && !empty($_SESSION[$key]))?
            $_SESSION[$key]:
            null;
    }

    public function write($key, $value){
        $_SESSION[$key] = $value;
        return $this;
    }

    public function destroy($key){
        unset($_SESSION[$key]);
        return $this;
    }
} 