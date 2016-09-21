<?php

include_once (__DIR__."/../../bootstrap.php");

include_once (__DIR__."/WS.php");
include_once(__DIR__."/WSTemplate.php");



use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;



class WSScheduler extends WS{
	
	private $iMaxActionPerTime = 1;

	public $oDBEntityManager = null;
	
	
	public function getAction(){
		$aResult = array();
		
		// Get session with limit
		$aSession = $this->oDBEntityManager->getRepository("Session")->findBy(array("sState"=>"doing"),array("sSessionId" => "ASC"),$this->iMaxActionPerTime);
		
		$iCountSession = 0;
		$iCountAction = 0;
		
		for ($i = 0; $i < count($aSession); $i++){
			
			
			// Change to doing all 
			$aSession[$i]->setState("waiting");
			$this->oDBEntityManager->persist($aSession[$i]);
			$this->oDBEntityManager->flush();
			
			//echo "Session #".$i." -> " . $aSession[$i]->getSession()."\n";
			
			$aAction = $aSession[$i]->getActions();
			for ($k = 0; $k < count($aAction); $k++){
				//echo "Session #".$i." Action #".$k." source ".$aAction[$k]->getSource()->getUri()." doing ".$aAction[$k]->getFullAction()."\n";
				array_push($aResult, $this->runAction($aAction[$k]));
			}
			
			// Commit result (also check for errors)
			for ($k =0 ; $k < count($aResult); $k++){
				$oResult = new Result();
				$oResult->setResult($aAction[$k], $aResult[$k]); // TODO Watch out for error and array reducing
				
				$this->oDBEntityManager->persist($oResult);
				
				$iCountAction++;
			}
			
			// Change state
			$aSession[$i]->setState("end");
			$this->oDBEntityManager->persist($aSession[$i]);
			$this->oDBEntityManager->flush();
			 $iCountSession++;
		}
		
		return "Exec done Sessions: ".$iCountSession." Actions:".$iCountAction."\n";
	}
	
	private function runAction($oAction){
		// TODO: Add gateway behavior

		// TODO VMware gw action
		
		// TODO this is a test
		return "{\"result\":\"true\"}";
	}
	
	
	
}

?>