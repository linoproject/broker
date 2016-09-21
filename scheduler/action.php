<?php 
include_once(__DIR__."/../config/config.php");
include_once(__DIR__."/../lib/ws/WSScheduler.php");


$oWS = new WSScheduler();

echo $oWS->getAction();


?>