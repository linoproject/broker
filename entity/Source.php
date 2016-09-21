<?php 
/**
 * @Entity @Table(name="source")
 **/
class Source {
	/** @Id @Column(type="integer") @GeneratedValue **/
	protected $id;
	
	/** @Column(type="string") **/
	protected $sSourceIdentifier;
	
	/** @Column(type="string") **/
	protected $uri; // Format: prot://uri:username@domain:password
	
	
	/** @OneToMany(targetEntity="Session", mappedBy="$fkSource") **/
	protected $fkActions;
	
	
	
	public function getId(){
		return $this->id;
	}
	
	public function getUri(){
		return $this->uri;
	}
	
	public function setId($sId){
		$this->id = $sId;
	}
	
	public function setData($sSourceIdentifier, $sUri){
		$this->sSourceIdentifier = $sSourceIdentifier;
		$this->uri = $sUri;
	}
	
}


?>