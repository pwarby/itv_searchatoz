<?php

/**
 * Exception for use in case of MercuryRequest 404
 */
class MercuryRequestNotFound extends Exception {
    public function __construct($message, $code = 404, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
