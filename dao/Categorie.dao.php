<?php
 
require_once("modele/Categorie.class.php");

class DaoCategorie {
	public function create(AbstractEntity $categorie) {
		$donnee = DB::select("INSERT INTO categories (nom, description) VALUES (?,?)", array($categorie->getNom(),$categorie->getDescription()));
		 $categorie->setId(DB::lastId());

		return $categorie;
	}
	public function read($id) {
		$donnee = DB::select("SELECT id, nom, description FROM categories 
                                WHERE id = ?", array($id));
		if(!empty($donnee)) {
			$categorie = new Categorie($donnee[0]['nom'],$donnee[0]['description']);
			$categorie->setId($donnee[0]['id']);
		} else {
			return null;
		}

		return $categorie;
	}
	public function readAll() {
		$donnee = DB::select("SELECT id, nom, description FROM categories");
		$tabCats = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				$tabCats[$key] = new Categorie($donnee[$key]['nom'],$donnee[$key]['description']);
				$tabCats[$key]->setId($donnee[$key]['id']);
			}
		} else {
			return null;
		}
		return $tabCats;

	}
	public function update($categorie) {
		DB::select("UPDATE categories SET nom = ?,  description = ? WHERE id = ?",array($categorie->getNom(),$categorie->getDescription(), $categorie->getId()));
	}
	public function delete($id) {
		$donnee = DB::select("DELETE FROM categories WHERE id = ?",array($id));
	}
}

?>


