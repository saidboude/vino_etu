<?php

class Cellier extends Modele {
	const TABLE = 'vino__cellier';

    /**
     * Fonciton qui obtien la liste des celliers
     */
	public function getListeCelliers($id_usager)
	{
		$rows = Array();
		$res = $this->_db->query("SELECT * FROM vino__cellier WHERE id_usager = '" . $id_usager . "'");
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
	 * Fonction qui obtien un cellier
	 */
	public function getCellier($id)
	{
		$rows = Array();
		$res = $this->_db->query("SELECT * FROM vino__cellier WHERE id = '" . $id . "'");
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
	 * Fonction qui ajoute un cellier
	 * 
	 * @param Array $data Tableau des données représentants le cellier.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterCellier($data)
	{
		$requete ="INSERT INTO vino__cellier(nom, lieu, id_usager) 
		VALUES ('".$data['nom']."', '".$data['lieu']."', ".$_SESSION['usager'][0]['id'].")";

        $res = $this->_db->query($requete);
		return $res;
	}

	/**
	 * Fonction qui supprimer un cellier
	 */
	public function deletecellier($id)
	{	
		$requete = "DELETE FROM vino__cellier WHERE id='" . $id . "'";

        $res = $this->_db->query($requete);
        
		return $res;

	}

	/**
	 * Fonction qui supprime les bouteille prive du cellier
	 */
	public function deletebteprive($id)
	{	
		$requete = "DELETE FROM vino__bouteille_prive WHERE id_cellier ='" . $id . "'";

        $res = $this->_db->query($requete);
        
		return $res;

	}
		/**
	 * Fonction qui supprime les bouteille saq du cellier
	 */
	public function deletebtesaq($id)
	{	
		$requete = "DELETE FROM vino__bouteille_saq WHERE id_cellier ='" . $id . "'";

        $res = $this->_db->query($requete);
        
		return $res;

	}
}
