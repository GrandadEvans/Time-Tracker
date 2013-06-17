<?php

if ($_REQUEST['action'] == 'start')
{
    echo 'Logged start even for project id: ' . $_REQUEST['id'];
    exit;
}
