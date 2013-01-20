<?php

class ProgrammeFactoryTest extends CIUnit_TestCase
{    
    public function __construct($name = NULL, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
    }
    
    public function setUp() {
        parent::tearDown();
        parent::setUp();

        $this->CI->load->model('Programme_Factory');
        $this->ProgrammeFactory = $this->CI->Programme_Factory;
    }

    public function testReturnType() {
        $programme = $this->ProgrammeFactory->create(null);
        $this->assertInstanceOf('Programme', $programme);
    }

    public function testCreationFromObject() {
        $json = file_get_contents(dirname(__FILE__) . '/../fixtures/Programme.json');
        $data = json_decode($json);
        $programme = $this->ProgrammeFactory->create($data);
        $this->assertInstanceOf('Programme', $programme);

        $this->assertEquals(4486, $programme->getId());

        $this->assertEquals("Test title", $programme->getTitle());

        $this->assertEquals("synopsis", $programme->getShortSynopsis());

        $this->assertEquals("imageUri", $programme->getImage());

        $this->assertEquals("https://www.itv.com/itvplayer/test-title", $programme->getUri());
    }

    public function testNormalisedSynopsis() {
        $json = file_get_contents(dirname(__FILE__) . '/../fixtures/Programme2.json');
        $data = json_decode($json);
        $programme = $this->ProgrammeFactory->create($data);
        $this->assertInstanceOf('Programme', $programme);

        $this->assertEquals("synopsis", $programme->getShortSynopsis());
    }
}
