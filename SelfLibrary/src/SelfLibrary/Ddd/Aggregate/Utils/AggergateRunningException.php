<?php
namespace SelfLibrary\Ddd\Aggregate\Utils;

use Exception;

class AggergateRunningException extends Exception {
	public function __construct($message = 'Aggregate occur exception during on running.', $code = null, $previous = null) {
		parent::__construct ( $message, $code, $previous );
	}
}