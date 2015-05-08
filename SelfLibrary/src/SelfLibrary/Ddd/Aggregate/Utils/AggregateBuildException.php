<?php
namespace SelfLibrary\Ddd\Aggregate\Utils;

use Exception;

class AggregateBuildException extends Exception {
	public function __construct($message = 'Aggregate occur exception during on build.', $code = null, $previous = null) {
		parent::__construct ( $message, $code, $previous );
	}
}