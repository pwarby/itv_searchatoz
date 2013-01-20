<?php

class ProgrammeModelTest extends CIUnit_TestCase
{    
    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
    }
    
    public function setUp() {
        parent::tearDown();
        parent::setUp();

        $this->CI->load->model('Programme');
        $this->Programme = $this->CI->Programme;
    }

    public function testMagicSetter() {
        $this->Programme->id = 1;
        $this->assertEquals(1, $this->Programme->getId());

        $this->Programme->title = "title";
        $this->assertEquals("title", $this->Programme->getTitle());

        $this->Programme->shortSynopsis = "synopsis";
        $this->assertEquals("synopsis", $this->Programme->getShortSynopsis());

        $this->Programme->imageUri = "imageUri";
        $this->assertEquals("imageUri", $this->Programme->getImage());

        $this->Programme->uri = "uri";
        $this->assertEquals("uri", $this->Programme->getUri());
    }
}
