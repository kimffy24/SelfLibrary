<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/21/15
 * Time: 5:00 PM
 */
namespace SelfLibrary\Infrastructure\Session\Storage;

use SelfLibrary\Infrastructure\Session\Storage\Utils\SessionStorageException;

class NormalSessionStorage {
    public function __construct(){
        if(session_status()==0)
            throw new SessionStorageException("Session can't use on system!");
        if(session_status()==1)
            session_start();
        return;
    }

    public function get($key){
        return (isset($_SESSION[$key]) && !empty($_SESSION[$key]))?
            $_SESSION[$key]:
            null;
    }

    public function set($key, $value){
        $_SESSION[$key] = $value;
        return $this;
    }

    public function reset($key){
        unset($_SESSION[$key]);
        return $this;
    }
} 