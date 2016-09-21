<?php

include_once (__DIR__."/../../bootstrap.php");

include_once(__DIR__."/WSTemplate.php");



use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;



class WS{
	
	public $sType = "json"; // May JSON/XML

	public $oDBEntityManager = null;
	
	private $oDBConfig = null;
	private $aDBConnection = array();
	
	public function WS(){
		
		$isDevMode = true;
		$this->oDBConfig = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../../entity/"), $isDevMode);
		$this->aDBConnection = array(
			'dbname' => BROKER_DB_NAME,
    		'user' => BROKER_DB_USER,
    		'password' => BROKER_DB_PASS,
    		'host' => BROKER_DB_HOST,
    		'driver' => 'pdo_mysql',
		);
		
		$this->oDBEntityManager = EntityManager::create($this->aDBConnection, $this->oDBConfig);
		return true;		
	}
	
	
	
	public function lasterror(){
		
	}
	
	protected function error($iCode, $sReason){
		return WSTemplate::returnError($iCode, $sReason);
	}
	
	protected function test(){
		return WSTemplate::test();
	}
	
}

?>