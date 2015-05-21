<?php
/**
 * Created by PhpStorm.
 * User: jiefzz
 * Date: 5/18/15
 * Time: 3:32 PM
 */
function smarty_function_U($params, $smarty) {
	$viewHelperUrl = $smarty->getServiceLocator ()->get ( 'TinyBS\View\Helper\Url' );
	return call_user_func_array ( array (
			$viewHelperUrl,
			'__invoke' 
	), $params ['p'] );
}