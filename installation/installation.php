<?php 
include_once (__DIR__.'/../bootstrap.php');

// Check existing user
$oUserRepository = $oDBEntityManager->getRepository("User");

$aUser = $oUserRepository->findBy(array("sUserName"=>"Anonymous"));

if (count($aUser) == 0){
	$oAnonUser = new User();
	$oAnonUser->setUserName("Anonymous");
	$oDBEntityManager->persist($oAnonUser);
	$oDBEntityManager->flush();
	
	echo "Created User Anonymous with id ".$oAnonUser->getId()."\n";
}else{
	echo "Anon User already present \n";
}

?>