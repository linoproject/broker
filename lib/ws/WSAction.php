<?php

include_once (__DIR__."/../../bootstrap.php");

include_once (__DIR__."/WS.php");
include_once(__DIR__."/WSTemplate.php");



use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;



class WSAction extends WS{
	
	

	
	public $sUserId = 1;
	
	
	public function launch($sFunction="", $sAction="", $sSessionId="", $oData=null){
		if ($sFunction == ""){
			return $this->test();
		}else{
			switch ($sFunction){
				case "start":
					if ($this->sUserId > 0){
						return $this->startSession();
					}else{
						return $this->error(102);
					}
				break;
				case "end":
					if ($sSessionId == ""){
						return $this->error(103);
					}else{
						return $this->endSession($sSessionId);
					}
				break;
				case "action":
					if ($sAction == ""){
						return $this->error(101);
					}else{
						
						///////////Test source
						$oSource = $this->oDBEntityManager->getRepository("Source")->find(1);
						$sGateway = "vmware";
						///////////////////
						
						$oSession = $this->oDBEntityManager->getRepository("Session")->findOneBy(array("sSessionId"=>$sSessionId));
						if ($oSession == null){
							return WSTemplate::returnError(104);
						} 
						
						return $this->addAction($oSession, $oSource, $sGateway, $sAction);
					}
				break;
				case "event":
					if ($sAction == ""){
						return $this->error(101);
					}else{
						//return $this->startAsyncSession($sAction);
						return $this->test();
					}
					
				break;
				default:
					return $this->test();
				break;
				
			}
			
		}
	}
	
	private function startSession(){
		
		// Check prev session for this user
		$oUser = $this->oDBEntityManager->getRepository("User")->find($this->sUserId);
		
		// Insert session into DB
		$oSession = new Session();
		$oSession->autoSetSession($oUser);
		$this->oDBEntityManager->persist($oSession);
		$this->oDBEntityManager->flush();
	
		
		
		return WSTemplate::returnSession($oSession->getSession());
	}
	
	private function endSession($sSessionId){
		
		
		
		$oSession = $this->oDBEntityManager->getRepository("Session")->findOneBy(array("sSessionId" => $sSessionId));
		
		if ($oSession != null){
			
			$oSession->setState("end");
			
			$this->oDBEntityManager->persist($oSession);
			$this->oDBEntityManager->flush();
			
			return WSTemplate::returnAction("end session", "true");
			
		}else{
			
			return WSTemplate::returnError(104);
		}
		// Mark end session
		
	
	}
	
	private function addAction($oSession, $oSource, $sGateway, $sAction){
		
		
		$oAction = new Action();
		$oAction->addSource($oSource);
		$oAction->addSession($oSession);
		$oAction->setAction($sAction);
		
		$oSession->setState("doing");
		
		$this->oDBEntityManager->persist($oAction);
		$this->oDBEntityManager->persist($oSession);
		$this->oDBEntityManager->flush();
		
		return WSTemplate::returnAction("new action: ".$sAction,"true");
	}
	
	private function checkSession($sSessionId){
		
	}
	
}

?>