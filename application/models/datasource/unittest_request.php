<?php

/**
 * Request model in order to fixture Mercury data during unit testing
 */
class Unittest_Request extends CI_Model implements RequestInterface {
    /**
     * Rewrites provided URL in order to check fixtures directory for relevant
     * data.
     * 
     * @param  string  $url   Feed url
     * @param  boolean $cache cache status (unused)
     * @return object
     */
    function request($url, $cache = true) {
        $url = str_replace('http://', '', $url);
        $url = str_replace('/', '_', $url);

        $url .= '.json';

        $json = file_get_contents(BASEPATH . '../tests/fixtures/' . $url);
        $result = json_decode($json);

        return $result;
    }
}