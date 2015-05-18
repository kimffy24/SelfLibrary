<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/18/15
 * Time: 4:52 PM
 */
namespace SelfLibrary\Infrastructure\Utils;

use Exception;


class InfrastructureException extends Exception {

    public function __construct($msg=null, $code=null, Exception $previous=null){
        parent::__construct($msg?$msg:"There some error occur while construct Infrastructure!", $code, $previous);
    }

}