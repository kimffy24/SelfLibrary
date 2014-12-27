<?php
namespace SelfLibrary\Ddd\Repository\Utils;

use Exception;

class RepositoryGetInstanceException extends Exception
{
    public function __construct($message='Some excpetion occur when get object from repository!', $code=null, $previous=null){
        parent::__construct($message, $code, $previous);
    }
}