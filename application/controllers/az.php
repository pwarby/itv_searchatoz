<?php

/**
 * A-Z page controller
 */
class Az extends CI_Controller {

    /**
     * A-Z page view
     * @param  string $letter Letter, or string of letters, to search the A-Z feed for.
     */
    public function view($letter = '') {
        if (
            $letter &&
            $letter !== '0-9' &&
            preg_match('/[^a-zA-Z0-9]+/', $letter)
        ) {
            log_message('error', 'Invalid character supplied: ' . $letter);
            $letter = '';
        }
        $this->load->model('feeds/AZ_Feed');
        $programmes = $this->AZ_Feed->getAZ($letter);

        $data = array();

        $data['title'] = 'A-Z';
        $data['letter'] = $letter;
        $data['azlist'] = $this->_getAZList();
        $data['programmes'] = $programmes;

        $this->load->view('templates/header', $data);
        $this->load->view('az/index', $data);
        $this->load->view('az/az_list', $data);

        if (count($programmes)) {
            $this->load->view('az/programme_list', $data);
        } else {
            $this->load->view('az/no_results', $data);
        }
        $this->load->view('templates/footer', $data);
    }

    /**
     * Generate an array of letters from a to z for use in the listing.
     * @return array array of letters and the string '0-9'
     */
    private function _getAZList () {
        $items = range('a', 'z');
        array_unshift($items, '0-9');

        return $items;
    }
}