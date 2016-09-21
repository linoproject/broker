<?php
include_once(__DIR__."/../../config/config.php");
include_once(__DIR__."/../../lib/ws/WSAction.php");


$oWS = new WSAction();

echo $oWS->launch($_GET["function"], $_GET["action"], $_GET["session"]);


?>