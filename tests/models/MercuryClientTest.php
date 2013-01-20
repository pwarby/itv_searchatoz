<?php

class MercuryClientTest extends CIUnit_TestCase
{    
    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
    }
    
    public function setUp() {
        parent::tearDown();
        parent::setUp();

        $this->CI->load->model('datasource/Mercury_Client');
        $this->MercuryClient = $this->CI->Mercury_Client;
    }

    public function testFetch() {
        $object = $this->MercuryClient->fetch('searchatoz/a');

        $this->assertInternalType('object', $object);
    }
}
