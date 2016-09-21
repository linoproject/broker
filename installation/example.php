<?php 
include_once (__DIR__.'/../bootstrap.php');

// Check existing user
$oUserRepository = $oDBEntityManager->getRepository("Source");
$oSource = $oUserRepository->findOneBy(array("sSourceIdentifier"=>"Test1"));

if ($oSource == null){
	$oSourceTest1 = new Source();
	$oSourceTest1->setData("Test1", "http://vcenter1:8999/:user:pass");
	$oDBEntityManager->persist($oSourceTest1);
	$oDBEntityManager->flush();
	
	echo "Created Test Source with id ".$oSourceTest1->getId()."\n";
}else{
	echo "Test Source already present \n";
}


// Proxy

// Gateway





?>