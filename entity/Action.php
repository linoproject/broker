<?php 
/**
 * @Entity @Table(name="action")
 **/
class Action {
	/** @Id @Column(type="integer") @GeneratedValue **/
	protected $id;
	
	/** @Column(type="string") **/
	protected $sAction;
	
	/** @ManyToOne(targetEntity="Session", inversedBy="fkActions") **/
	protected $fkSession;
	
	/** @ManyToOne(targetEntity="Source", inversedBy="fkActions") **/
	protected $fkSource;
	
	/** @OneToMany(targetEntity="Result", mappedBy="fkAction") **/
	protected $fkResults;
	
	// TODO
	protected $fkGateway;
	protected $fkOperation;
	protected $fkParam;
		
	public function getId(){
		return $this->id;
	}
	
	public function getFullAction(){
		return "{\"gw\":\"vmware\",\"action\":\"".$this->sAction."\"}";
	}
	
	public function getSource(){
		return $this->fkSource;
	}
	
	public function setId($sId){
		$this->id = $sId;
	}
	
	public function addSource($oSource){
		$this->fkSource = $oSource;
	}
	public function addSession($oSession){
		$this->fkSession = $oSession;
	}
	public function setAction($sAction){
		$this->sAction = $sAction;
	}
	
}


?>