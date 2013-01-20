<?php

/**
 * Exception for use in case of MercuryRequest returning empty dataset
 */
class MercuryRequestEmpty extends Exception {
    public function __construct($message, $code = 204, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
