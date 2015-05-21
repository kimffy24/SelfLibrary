<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/21/15
 * Time: 5:02 PM
 */
namespace SelfLibrary\Infrastructure\Session\Storage\Utils;

use Exception;

class SessionStorageException extends Exception {
    public function __construct($msg="There some exception occur while use Object in Session\\Storage\\* !", $code=-1, $previous=null){
        parent::__construct($msg, $code, $previous);
    }
} 