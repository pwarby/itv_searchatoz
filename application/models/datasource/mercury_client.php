<?php

class Mercury_Client extends CI_Model {
    /**
     * Mercury URL
     * @var String
     */
    private $baseURL;

    /**
     * On consturct load the mercury config file
     */
    function __construct() {
        $this->config->load('mercury', TRUE);
        $this->mercuryConfig = $this->config->item('mercury');
    }

    /**
     * Fetch data for the specified feed
     * @param  String $feed    Feed name
     * @return Object          Object representation of feed
     */
    function fetch($feed) {
        $url = $this->constructMercuryURL($feed);
        $output = null;

        if (ENVIRONMENT === 'testing') {
            $this->load->model('datasource/Unittest_Request', 'Request');
        } else {
            $this->load->model('datasource/Mercury_Request', 'Request');
        }

        $output = $this->Request->request($url);

        return $output;
    }

    /**
     * Construct a feed URL based on feed name and parameters
     * @param  String $feed    Feed name
     * @return String
     */
    private function constructMercuryURL($feed) {
        if (!isset($this->baseURL)) {
            $this->baseURL = $this->mercuryConfig['url'] . $this->mercuryConfig['target'] . '/' . $this->mercuryConfig['platform'] . '/';
        }
        
        return $this->baseURL . 'programme/' . $feed;
    }
}