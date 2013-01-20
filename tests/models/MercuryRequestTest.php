<?php

class MercuryRequestTest extends CIUnit_TestCase
{    
    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
    }
    
    public function setUp() {
        parent::tearDown();
        parent::setUp();

        $this->CI->load->model('datasource/Mercury_Request');
        $this->MercuryRequest = $this->CI->Mercury_Request;
    }

    public function testRequest() {
        $object = $this->MercuryRequest->request('http://mercury.itv.com/api/json/dotcom/programme/searchatoz/d', false);

        $this->assertInternalType('object', $object);
    }

    /**
     * @expectedException MercuryRequestNotFound
     */
    public function test404Error() {
        $object = $this->MercuryRequest->request('http://mercury.itv.com/api/json/dotcom/programme/searchatoz/d/thisisa404', false);
    }

    /**
     * @expectedException MercuryRequestEmpty
     */
    public function testEmptyError() {
        $object = $this->MercuryRequest->request('http://mercury.itv.com/api/json/dotcom/programme/searchatoz/', false);
    }
}
