<?php

ini_set('display_errors', 'On');
require_once('./prelims.php');
require_once('./models/default.class.php');

if ($_REQUEST['action'] == 'start')
{

    $db = new defaultDB;

    $start = $db->startTimer($_GET['keyword'], $_GET['project_id']);

    if ($start == true)
    {
        echo 'ok';
        exit;
    }

    echo 'Error';
    exit;
} elseif ($_REQUEST['action'] == 'stop')
{
    $db = new defaultDB;

    $stop = $db->closeTimers();

    if ($stop == true)
    {
        echo 'ok';
        exit;
    }

    echo 'Error';
    exit;

}
