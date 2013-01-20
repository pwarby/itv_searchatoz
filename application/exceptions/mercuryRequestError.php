<?php

/**
 * Exception for use in case of MercuryRequest undefined errors
 */
class MercuryRequestError extends Exception {
    public function __construct($message, $code = 500, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
