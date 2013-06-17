<?php

class getProgramTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

        require_once('./getProgram.class.php');
    }


    public function testTitleBits()
    {

        $programs = new getProgram;

        $windowInfo = $programs->getWindowInfo();

        $bits = $programs->splitTitle();

        // Test the count
        $this->assertCount(2, $bits);
    }
}

