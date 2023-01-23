<?php
/**
 * Class Bouteille
 * Cette classe possède les fonctions de gestion des bouteilles dans le cellier et des bouteilles dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Bouteille extends Modele {
	const TABLE = 'vino__bouteille';
    
	public function getListeBouteille()
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
	
	public function getListeBouteilleCellier()
	{		
		$rows = Array();
		$requete ='SELECT 
						c.id as id_bouteille_saq,
						c.id_bouteille,
						c.id_cellier, 
						c.date_achat, 
						c.garde_jusqua, 
						c.notes, 
						c.prix, 
						c.quantite,
						c.millesime, 
						b.id,
						b.nom, 
						b.type, 
						b.image, 
						b.code_saq, 
						b.url_saq, 
						b.pays, 
						b.description,
						t.type 
						from vino__bouteille_saq c 
						INNER JOIN vino__bouteille b ON c.id_bouteille = b.id
						INNER JOIN vino__type t ON t.id = b.type
						'; 
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
				}
			}
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de donnée", 1);
			 //$this->_db->error;
		}
		
		return $rows;
	}
	
	/**
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */
       
	public function autocomplete($nom, $nb_resultat=10)
	{		
		$rows = Array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/","%" , $nom);
		 
		//echo $nom;
		$requete ='SELECT id, nom FROM vino__bouteille where LOWER(nom) like LOWER("%'. $nom .'%") LIMIT 0,'. $nb_resultat; 
		//var_dump($requete);
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(utf8_encode($row['nom']));// mb_convert_encoding
					$rows[] = $row;
					
				}
			}
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de données", 1);
			 
		}	
		
		//var_dump($rows);
		return $rows;
	}

	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre)
	{
		//TODO : Valider les données.
				
		$requete = "UPDATE vino__bouteille_saq SET quantite = GREATEST(quantite + ". $nombre. ", 0) WHERE id = ". $id;
		//echo $requete;
        $res = $this->_db->query($requete);
        
		return $res;
	}

		
	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleCellier($data)
	{
		//TODO : Valider les données.
		//var_dump($data);	
		//echo $data;
		$requete = "INSERT INTO vino__bouteille_saq(id_bouteille,id_cellier,date_achat,garde_jusqua,notes,prix,quantite,millesime) 
		VALUES (".
		"'".$data->id_bouteille."',".
		"'".$data->id_cellier."',".
		"'".$data->date_achat."',".
		"'".$data->garde_jusqua."',".
		"'".$data->notes."',".
		"'".$data->prix."',".
		"'".$data->quantite."',".
		"'".$data->millesime."')";
		//echo $requete;

        $res = $this->_db->query($requete);        
		return $res;
	}
	
	/**Récuperer une bouteille pour affichage et modification
	 * @param int id la bouteille à modifier
	*/
	public function getBouteilleCellier($id)
	{
		//var_dump($id);SELECT *., from vino__bouteille_saq WHERE id = $id
		$requete = "SELECT * , c.id as id_cellier, b.id as id_bouteille_modif, 
							s.nom as nom_saq, c.nom as nom_cellier 
					FROM `vino__bouteille_saq` b JOIN vino__bouteille s 
					ON s.id = b.id_bouteille JOIN vino__cellier c 
					ON c.id = b.id_cellier WHERE b.id = $id";
		$data = $this->_db->query($requete);
		$row = $data->fetch_assoc();
		//Lorsque s'integre l'usager on pourrais chercher tous ses celliers et les donner 
		//l'option de changer la bouteille de cellier.
		//$requete = "SELECT * FROM vino__cellier JOIN vino__bouteille_saq ON id_cellier=id WHERE id_usager=id_usager";
		 
		//print_r($row["notes"]);
		/* SELECT * , s.nom as nom_saq, c.nom as nom_cellier 
					FROM `vino__bouteille_saq` as b JOIN vino__bouteille as s 
					ON s.id = b.id_bouteille  
					WHERE b.id = 5 (SELECT * FROM vino__cellier as c ON c.id = b.id WHERE b.id = 5) */
				
		return $row;
	}
	
	/**Modification d'une bouteille */
	public function modifierBouteilleCellier($data)	
	{//`id_bouteille`='".$data->id_bouteille."', est id de vino_bouteille_saq
		$id = $data->id_bouteille;
		$requete = "UPDATE 	`vino__bouteille_saq` SET 
							`id_cellier`='".$data->id_cellier."', 
							`date_achat`='".$data->date_achat."',
							`garde_jusqua`='".$data->garde_jusqua."', 
							`notes`='".$data->notes."',
							`prix`='".$data->prix."',
							`quantite`='".$data->quantite."',
							`millesime`='".$data->millesime."' WHERE id = $id";
		//var_dump($requete);					
		$res = $this->_db->query($requete);
		
		return $res;

	} 


}




?>