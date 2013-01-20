<?php

/**
 * Programme factory
 */
class Programme_Factory extends CI_Model {

    static private $itvPlayerURL = 'https://www.itv.com/itvplayer/';

    /**
     * Generates a new Programme model
     * 
     * @param  object    $params Programme data from JSON data
     * @return Programme
     */
    public function create($params) {
        $this->load->model('Programme');

        $programme = new Programme();

        if (isset($params->Programme->Id)) {
            $programme->id = $params->Programme->Id;
        }

        if (isset($params->Programme->Title)) {
            $programme->title = trim($params->Programme->Title);
        }

        if ($programme->getTitle()) {
            $programme->uri = $this->getUriFromTitle($programme->getTitle());
        }

        if (isset($params->ImageUri)) {
            $programme->imageUri = $params->ImageUri;
        }

        $programme->shortSynopsis = $this->normaliseSynopsis($params);
        
        return $programme;
    }

    /**
     * Generate a programme URI from the programme title
     * 
     * @param  string $title Programme title
     * @return string
     */
    private function getUriFromTitle($title) {
        $uri = preg_replace('/(^[^a-z0-9]+)|([^a-z0-9]+$)/', '', mb_strtolower($title));
        $uri = preg_replace('/[^a-zA-Z0-9]+/', '-', $uri);
        $uri = self::$itvPlayerURL . $uri;

        return $uri;
    }

    /**
     * Normalises the synopsis variables. First checks the Programme object
     * synopsis, if this has no value will fall back to the root object synopsis.
     * 
     * @param  object $params Programme data from JSON data
     * @return string         The item short synopsis
     */
    private function normaliseSynopsis ($params) {
        $synopsis = '';
        if (
            isset($params->Programme->ShortSynopsis) &&
            $params->Programme->ShortSynopsis
        ) {
            $synopsis = $params->Programme->ShortSynopsis;
        } elseif (isset($params->ShortSynopsis)) {
            $synopsis = $params->ShortSynopsis;    
        }

        return $synopsis;
    }
}