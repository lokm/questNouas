<?php
 
require_once("modele/Categorie.class.php");

class DaoCategorie {
	public function create(AbstractEntity $categorie) {
		$donnee = DB::select("INSERT INTO categories (nom, description, lang) VALUES (?,?,?)", array($categorie->getNom(),$categorie->getDescription(), $categorie->getLang()));
		 $categorie->setId(DB::lastId());

		return $categorie;
	}
	public function read($id) {
		$donnee = DB::select("SELECT id, nom, description, lang FROM categories 
                                WHERE id = ?", array($id));
		if(!empty($donnee)) {
			$categorie = new Categorie($donnee[0]['nom'],$donnee[0]['description'],$donnee[0]['lang']);
			$categorie->setId($donnee[0]['id']);
		} else {
			return null;
		}

		return $categorie;
	}
	public function readAll() {
		$donnee = DB::select("SELECT id, nom, description, lang FROM categories");
		$tabCats = array();
		if(!empty($donnee)) {
			foreach ($donnee as $key => $value) {
				$tabCats[$key] = new Categorie($donnee[$key]['nom'],$donnee[$key]['description'],$donnee[$key]['lang']);
				$tabCats[$key]->setId($donnee[$key]['id']);
			}
		} else {
			return null;
		}
		return $tabCats;

	}

	public function update($categorie) {
		DB::select("UPDATE categories SET nom = ?,  description = ?,  lang = ? WHERE id = ?",array($categorie->getNom(),$categorie->getDescription(),$categorie->getLang(), $categorie->getId()));
	}
	public function delete($id) {
		$donnee = DB::select("DELETE FROM categories WHERE id = ?",array($id));
	}
}

?>


