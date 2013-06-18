<?php

class DB
{

    public $DBH;

    public function __construct()
    {
        $this->DBH = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => TRUE));
        $this->DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public function connect()
    {
    }


    public function query()
    {

    }
}
        ?>

