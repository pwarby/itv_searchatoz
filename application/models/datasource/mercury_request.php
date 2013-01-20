<?php

class Mercury_Request extends CI_Model implements RequestInterface {

    /**
     * Cache storage lifetime for feed data. In seconds
     */
    const CACHE_LIFETIME = 300;

    /**
     * Initiate a request to the provided URL
     * @param  String $url Mercury feed URL
     * @return Object
     */
    function request($url, $cache = true) {

        if ($cache) {
            $json = $this->getCachedFeed($url);
        } else {
            $json = $this->getFeed($url);
        }
        $result = json_decode($json);

        return $result;
    }

    /**
     * Attempts to retrieve feed data from app cache. Makes a new request for the data
     * if cache is empty.
     * @param  String $url Mercury feed URL
     * @return String
     */
    private function getCachedFeed($url) {
        $this->load->driver('cache', array('adapter' => 'apc'));

        if (!$this->cache->apc->is_supported()) {
            return $this->getFeed($url);
        }

        if(!$json = $this->cache->get($url)) {
            $json = $this->getFeed($url);

            $this->cache->save($url, $json, self::CACHE_LIFETIME);
        } else {
            log_message('debug', 'Mercury_Request CACHE HIT: ' . $url);
        }

        return $json;
    }

    /**
     * Retrieve feed data via cURL.
     * @param  String $url Mercury feed URL
     * @return String
     */
    private function getFeed($url) {
        $buffer = '';

        log_message('debug', 'Mercury_Request CACHE MISS: ' . $url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        $buffer = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if (!$buffer || count($buffer) < 1) {
            switch ($code) {
                case 404:
                    throw new MercuryRequestNotFound('Page not found: ' . $url);
                    break;
                case 200:
                    throw new MercuryRequestEmpty('No data: ' . $url);
                    break;
                default:
                    throw new MercuryRequestError('Undefined error: '. $url, $code);
            }
        }

        return $buffer;
    }
}