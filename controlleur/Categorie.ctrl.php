<?php 
class CtrlCategorie extends Controller {
	function update() {
		$this->loadDao('Categorie');

		$this->cat = $this->Categorie->read($this->input['catId']);

		$this->cat->setNom($this->input['catNom']);
		$this->cat->setDescription($this->input['catDesc']);
		$this->Categorie->update($this->cat);


		header('Location:'.WEBROOT.'Questionnaire/index');
	}

	function delete($id) {
		$this->loadDao('Categorie');

		$this->Categorie->delete($id);
		header('Location:'.WEBROOT.'Questionnaire/index');
	}
}
 ?>