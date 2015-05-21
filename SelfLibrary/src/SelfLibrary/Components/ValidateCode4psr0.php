<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/21/15
 * Time: 10:39 AM
 */

namespace SelfLibrary\Components;

if(!defined('B_VALIDATE_CODE_ROOT_PATH')){
    define('B_VALIDATE_CODE_ROOT_PATH', dirname(__DIR__).DS.'..'.DS.'..'.DS.'ext_lib'.DS.'bValidateCode'.DS);
    require B_VALIDATE_CODE_ROOT_PATH.'core'.DS.'ValidateCode.class.php';
}

use \ValidateCode;

class ValidateCode4psr0 extends ValidateCode{
} 