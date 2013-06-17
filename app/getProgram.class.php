<?php

class getProgram
{

    public $host = 'server';
    public $windowInfo;

    public function __construct()
    {

        // Nothing is happening here as yet
        return true;
    }

    public function worker()
    {
        $this->getWindowInfo();

        $bits = $this->splitTitle();

        $title = $this->extractTitle($bits);

        return $title;
    }

    public function getWindowInfo()
    {
        $this->windowInfo = exec("./getTitle.sh 2>&1");

    }

    public function splitTitle()
    {
        // We need to get rid of the hostname
        $bits = explode(' ' . $this->host . ' ' , $this->windowInfo);

        return $bits;

    }

    public function extractTitle($bits)
    {
        if (count($bits) > 1)
        {

            // Much as we'd expect
            // So we want the information after the server name
            $server = $bits[1];

            return $server;

        } else {
            throw new Exception('Unexpected Window Title');
        }
    }
}
