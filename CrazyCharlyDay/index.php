<?php
require_once 'vendor/autoload.php';
session_start();

try{
    \ccd\db\ConnectionFactory::setConfig('./../db.ini');
    $db = \ccd\db\ConnectionFactory::makeConnection();
}catch (Error $ignored){
    echo "problème avec la base de donnée.";
}


$action = null;
$html = "";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
$disp = new \ccd\dispatch\Dispatcher($action);
$disp->run();