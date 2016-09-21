<?php
include_once (__DIR__."/../../bootstrap.php");


$oUserRepository = $oDBEntityManager->getRepository("Source");
$oSource = $oUserRepository->findOneBy(array("sSourceIdentifier"=>"Test1"));

// Anonymous
$oUser = $oDBEntityManager->getRepository("User")->find(1);

// insert session
$oSession = $oDBEntityManager->getRepository("Session")->findOneBy(array("sSessionId"=>"00000000000000"));

if($oSession == null){
	echo "New test Session being created!\n";
	$oSession = new Session();
	$oSession->autoSetSession($oUser);
	$oSession->forceSessionId("00000000000000");
	$oSession->setState("doing");
	$oDBEntityManager->persist($oSession);
	$oDBEntityManager->flush();
	
}else if($oSession->getState() != "doing") {
	
	echo "test Session will be modified\n";
	
	$oSession->setState("doing");
	$oDBEntityManager->persist($oSession);
	$oDBEntityManager->flush();
}else{
	echo "Session already present and ready for actions\n";
}


// insert action if nothing found
$oSource = $oDBEntityManager->getRepository("Source")->find(1);
$aAction = $oDBEntityManager->getRepository("Action")->findBy(array("fkSession"=>$oSession));

if (count($aAction) < 1){
	
	
	$oAction = new Action();
	$oAction->addSession($oSession);
	$oAction->addSource($oSource);
	$oAction->setAction("getAllVM()");
	$aResult = $oDBEntityManager->persist($oAction);
	$oDBEntityManager->flush();
	
	echo "Create a default action\n";
}else{
	// Purge results
	for ($i = 0; $i < count($aAction); $i++){
		$aResult = $oDBEntityManager->getRepository("Result")->findBy(array("fkAction" => $aAction[$i]));
		
		for ($k = 0; $k < count($aResult); $k++){
			$oDBEntityManager->remove($aResult[$k]);
			$oDBEntityManager->flush();
		} 
		
	}
	
	echo "Purge old results\n";
}

// purge results


echo "Run scheduler now!\n";

?>