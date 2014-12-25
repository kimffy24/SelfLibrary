<?php 
namespace SelfLibrary\Ddd;

use Exception;

class DddException extends Exception{
    public function __construct($message, $code=null, $previous=null){
        parent::__construct($message, $code, $previous);
    }
}