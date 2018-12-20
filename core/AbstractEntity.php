<?php 

abstract class AbstractEntity {
	protected $id;

	public function setId($id) {
		$this->id = $id;
	}	
 }
?>