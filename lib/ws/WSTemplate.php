<?php 

include_once (__DIR__."/../../config/error.php");

class WSTemplate{
	
	public static function test(){
		return "{\"result\":\"true\"}";
	}
	
	public static function returnSession($sSession){
		return "{\"session\":\"".$sSession."\",".
		"\"result\":\"true\"}";
	}
	
	public static function returnError($iCode){
		
		return "{".
					"\"result\":\"false\"".
					"\"err_code\":\"".$iCode."\",".
					"\"err_msg\":\"".constant("BROKER_ERR_".$iCode)."\",".
				
				"}";
	}
	
	public static function returnAction($sAction,$bResult){
		return "{".
					"\"action\":\"".$sAction."\",".
					"\"result\":\"".$bResult."\"".
				"}";
	} 
	
}

?>