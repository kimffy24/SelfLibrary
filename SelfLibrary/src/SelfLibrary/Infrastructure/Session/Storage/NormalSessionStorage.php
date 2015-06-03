<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/21/15
 * Time: 5:00 PM
 */
namespace SelfLibrary\Infrastructure\Session\Storage;

use SelfLibrary\Infrastructure\Session\Storage\Utils\AbstractSessionStorage;
use SelfLibrary\Infrastructure\Session\Storage\Utils\SessionStorageException;

class NormalSessionStorage extends AbstractSessionStorage {
    public function __construct(){
        session_start();
    }

    public function read($key){
        /*return (isset($_SESSION[$key]) && !empty($_SESSION[$key]))?
            $_SESSION[$key]:
            null;*/
    }

    public function write($key, $value){
        /*$_SESSION[$key] = $value;
        return $this;*/
    }

    public function destroy($key){
        /*unset($_SESSION[$key]);
        return $this;*/
    }

    public function open($path=null, $name=null){
        return true;
    }
    public function close(){
        return true;
    }
    public function gc(){
        return true;
    }
}