<?php 
// Classe abstraite pour définir l'id
abstract class AbstractEntity {
	protected $id;

	public function setId($id) {
		$this->id = $id;
	}	
 }
?>