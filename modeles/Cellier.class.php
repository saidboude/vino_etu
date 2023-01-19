<?php
/**
 * Class Cellier
 * Cette classe possède les fonctions de gestion des celliers d'un usager.
 * 
 * @author Said Boudehane
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Cellier extends Modele {
	const TABLE = 'vino__cellier';

    /**
     * Obtenir la liste des celliers
     */
	public function getListeCelliers()
	{
		
		$rows = Array();
		$res = $this->_db->query('Select * from '. self::TABLE);
		if($res->num_rows)
		{
			while($row = $res->fetch_assoc())
			{
				$rows[] = $row;
			}
		}
		
		return $rows;
	}
	
	
	/**
	 * Cette méthode ajoute un ou modifier cellier
	 * 
	 * @param Array $data Tableau des données représentants le cellier.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterCellier($data)
	{
		//TODO : Valider les données.
		//var_dump($data);	
		
		$requete = "INSERT INTO vino__cellier(nom, lieu, id_usager) VALUES (".
		"'".$data['nom']."',".
		"'".$data['lieu']."', 2)";

        $res = $this->_db->query($requete);
		return $res;
	}

	

}




?>