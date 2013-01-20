<?php

class AZFeedTest extends CIUnit_TestCase
{    
    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
    }
    
    public function setUp() {
        parent::tearDown();
        parent::setUp();

        $this->CI->load->model('feeds/AZ_Feed');
        $this->AZFeed = $this->CI->AZ_Feed;
    }

    public function testGetAll() {
        $array = $this->AZFeed->getAZ();
        $this->assertInternalType('array', $array);
        $this->assertEquals(183, count($array));
        $this->assertContainsOnly('Programme', $array);
    }

    public function testGetOne() {
        $array = $this->AZFeed->getAZ('a');

        $this->assertInternalType('array', $array);
        $this->assertEquals(10, count($array));
        $this->assertContainsOnly('Programme', $array);
    }

    public function testGetMultiple() {
        $array = $this->AZFeed->getAZ('abc');

        $this->assertInternalType('array', $array);
        $this->assertEquals(36, count($array));
        $this->assertContainsOnly('Programme', $array);
    }

    public function testGetNumeric() {
        $array = $this->AZFeed->getAZ('0123456789');

        $this->assertInternalType('array', $array);
        $this->assertEquals(2, count($array));
        $this->assertContainsOnly('Programme', $array);
    }
}
