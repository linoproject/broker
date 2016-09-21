<?php 
/**
 * @Entity @Table(name="session")
 **/
class Session {
	/** @Id @Column(type="integer") @GeneratedValue **/
	protected $id;
	
	/** @ManyToOne(targetEntity="User", inversedBy="fkSessions") **/
	protected $fkUser;
	
	/** @Column(type="string") **/
	protected $sSessionId;
	
	/** @Column(type="string") **/ 
	protected $sState; // Could be start, doing, waiting, end // end-> result are present
	
	/** @OneToMany(targetEntity="Action", mappedBy="fkSession") **/
	protected $fkActions; 
	
	public function getId(){
		return $this->id;
	}
	
	public function getState(){
		return $this->sState;
	}
	
	public function getSession(){
		return $this->sSessionId;
	}
	
	public function getActions(){
		return $this->fkActions;
	}
	
	public function autoSetSession($oUser){
		$this->sSessionId = date("YmdHis");
		$this->fkUser = $oUser;
		$this->sState = "start";
	
	}
	
	public function forceSessionId($sSessionId){
		$this->sSessionId = $sSessionId;
	}
	
	public function setState($sState){
		$this->sState = $sState;
	}
	
}

?>