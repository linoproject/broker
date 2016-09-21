<?php 
/**
 * @Entity @Table(name="user")
 **/
class User {
	/** @Id @Column(type="integer") @GeneratedValue **/
	protected $id;
	
	/** @Column(type="string") **/
	protected $sUserName;
	
	/** @OneToMany(targetEntity="Session", mappedBy="fkUser") **/
	protected $fkSessions;
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($sId){
		$this->id = $sId;
	}
	
	public function getUserName(){
		return $this->sUserName;
	}
	
	public function setUserName($sUserName){
		$this->sUserName = $sUserName;
	}
}


?>