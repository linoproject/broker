<?php 

/**
 * @Entity @Table(name="result")
 **/
class Result {
	/** @Id @Column(type="integer") @GeneratedValue **/
	protected $id;

	/** @Column(type="string") **/
	protected $sContent;

	/** @ManyToOne(targetEntity="Action", inversedBy="fkResults") **/
	protected $fkAction;
	
	
	public function setResult($oAction, $sResult){
		$this->fkAction = $oAction;
		$this->sContent = $sResult;
	}

	
}

?>