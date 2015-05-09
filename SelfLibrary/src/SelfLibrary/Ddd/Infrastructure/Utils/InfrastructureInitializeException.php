<?php
namespace SelfLibrary\Ddd\Infrastructure\Utils;

use \Exception;

class InfrastructureInitializeException extends Exception {
    public function __construct($message='Some error occur on infrastructure initializing!', $code=null, $previous=null){
        parent::__construct($message, $code, $previous);
    }
}