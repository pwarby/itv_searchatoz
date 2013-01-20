<?php

/**
 * AZ Feed
 */
class AZ_Feed extends CI_Model {

    /**
     * Feed identifier
     * @var string
     */
    private $feed = 'searchatoz';

    /**
     * Retrieves an array of Programme items from the searchatoz feed
     * @param  string $filter Letters o numbers to filter by, or null to retrieve all
     * @return array          An array of Programme models
     */
    function getAZ($filter = null) {
        $programmes = array();

        $filter = $this->sanitizeInput($filter);

        // If no filter provided use the letters from a-z plus numbers from 0-9
        if (!$filter) {
            $filter = implode('', range('a', 'z'));
            $filter .= '0123456789';
        }

        $this->load->model('datasource/Mercury_Client');

        try {
            $feed = $this->Mercury_Client->fetch($this->feed . '/' . $filter);
        } catch (Exception $e) {
            log_message('error', get_class($e) . ': ' . $e->getMessage());
            // If mercury client encounters an error return a blank result set
            return $programmes;
        }

        if (isset($feed->Result) && count($feed->Result) && $feed->Result[0]->TotalCount) {
            $this->load->model('Programme_Factory');

            foreach ($feed->Result[0]->Details as $result) {
                if ($result->Programme) {
                    $programmes[] = $this->Programme_Factory->create($result->Programme);
                }
            }
        }

        return $programmes;
    }

    /**
     * Cleans filter input in order to strip undesirable characters.
     * Also converts 0-9 into 0123456789.
     * @param  string $input Input to sanitize
     * @return string        Sanitized input
     */
    private function sanitizeInput($input) {
        if ($input === '0-9') {
            $input = '0123456789';
        }

        $input = preg_replace('/[^a-zA-Z0-9]+/', '', $input);

        return $input;
    }
}