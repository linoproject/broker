<?php 

include_once (__DIR__.'/vendor/autoload.php');
include_once (__DIR__.'/config/config.php');
include_once (__DIR__."/config/error.php");

// Entities
include_once (__DIR__.'/entity/User.php');
include_once (__DIR__.'/entity/Session.php');
include_once (__DIR__.'/entity/Action.php');
include_once (__DIR__.'/entity/Source.php');
include_once (__DIR__.'/entity/Result.php');



use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


$isDevMode = true;
$oDBConfig = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/entity/"), $isDevMode);
$aDBConnection = array(
		'dbname' => BROKER_DB_NAME,
    	'user' => BROKER_DB_USER,
    	'password' => BROKER_DB_PASS,
    	'host' => BROKER_DB_HOST,
    	'driver' => 'pdo_mysql',
);

$oDBEntityManager = EntityManager::create($aDBConnection, $oDBConfig);

?>