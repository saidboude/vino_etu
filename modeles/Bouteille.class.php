<?php

class Bouteille extends Modele {
	const TABLE = 'vino__bouteille';
    
	/**
	 * Fonction qui obtien la liste de la saq
	 */
	public function getListeBouteille()
	{
		
		$rows = Array();
		$res = $this->_db->query('SELECT * FROM '. self::TABLE);
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
	 * Fonction qui obtien les types
	 */
	public function getListeType()
	{
		
		$rows = Array();
		$res = $this->_db->query('SELECT * FROM vino__type');
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
 * Fonction qui obtien les info pour bouteille saq
 */
	public function getListeBouteilleSAQ($id_cellier)
	{
		$rows = Array();
		$res = $this->_db->query("SELECT vb.id, vb.nom, vb.image, vb.code_saq, vb.pays, vb.description, vb.prix_saq, vb.url_saq, vb.url_img, vb.format, vb.type, vbs.id as vbsid, vbs.id_bouteille, vbs.id_cellier, vbs.date_achat, vbs.garde_jusqua, vbs.notes, vbs.quantite, vbs.millesime FROM vino__bouteille as vb JOIN vino__bouteille_saq as vbs ON vb.id = vbs.id_bouteille WHERE id_cellier = '" . $id_cellier . "'");
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
 * Fonction qui obtien les info pour bouteille prive
 */
	public function getListeBouteillePrive($id_cellier)
	{
		$rows = Array();
		$res = $this->_db->query("SELECT * FROM vino__bouteille_prive WHERE id_cellier = '" . $id_cellier . "'");
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
		 
		$requete ='SELECT id, nom FROM vino__bouteille where LOWER(nom) like LOWER("%'. $nom .'%") LIMIT 0,'. $nb_resultat; 

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
			throw new Exception("Erreur de requête sur la base de données", 1);
			 
		}
		return $rows;
	}
	
	
	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
/* 	public function ajouterBouteilleCellier($data)
	{
		//TODO : Valider les données.
		//var_dump($data);	
		
		$requete = "INSERT INTO vino__bouteille_saq(id_bouteille,id_cellier,date_achat,garde_jusqua,notes,quantite,pays,id_type,millesime) VALUES (".
	
		"'".$data->id_bouteille."',".
		"'".$data->id_cellier."',".
		"'".$data->date_achat."',".
		"'".$data->garde_jusqua."',".
		"'".$data->notes."',".
		"'".$data->quantite."',".
		"'".$data->pays."',".
		"'".$data->id_type."',".
		"'".$data->millesime."')";

        $res = $this->_db->query($requete);
        
		return $res;
	} */

	/**
	 * Fonction qui ajoute une bouteille saq
	 */
	public function ajouterBouteilleCellier($data)
	{
		
		$requete = "INSERT INTO vino__bouteille_saq(id_cellier,id_bouteille,date_achat,garde_jusqua,quantite,millesime) VALUES (".
		"'".$data->id_cellier."',".
		"'".$data->id_bouteille."',".
		"'".$data->date_achat."',".
		"'".$data->garde_jusqua."',".
		"'".$data->quantite."',".
		"'".$data->millesime."')";

        $res = $this->_db->query($requete);
        
		return $res;
	}
	
	/**
	 * Fonction qui ajoute bouteille prive
	 */
	public function ajouterBouteilleCellierPrive($data)
	{
		
		$requete = "INSERT INTO vino__bouteille_prive(nom,id_cellier,date_achat,garde_jusqua,prix_achat,quantite,pays,id_type,millesime) VALUES (".
		"'".$data['nom']."',".
		"'".$data['id_cellier']."',".
		"'".$data['date_achat']."',".
		"'".$data['garde_jusqua']."',".
		"'".$data['prix_achat']."',".
		"'".$data['quantite']."',".
		"'".$data['pays']."',".
		"'".$data['id_type']."',".
		"'".$data['millesime']."')";

        $res = $this->_db->query($requete);
        
		return $res;
	}

	/**
	 * Fonction qui supprime bouteille prive
	 */
	public function deleteprive($id)
	{	
		$requete = "DELETE FROM vino__bouteille_prive WHERE id='" . $id . "'";

        $res = $this->_db->query($requete);
        
		return $res;

	}
	/**
	 * Fonction qui supprime bouteille saq
	 */
	public function deleteSAQ($id)
	{	
		$requete = "DELETE FROM vino__bouteille_saq WHERE id_bouteille = '" . $id . "'";

        $res = $this->_db->query($requete);
        
		return $res;

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

		$requete = "UPDATE vino__bouteille_prive SET quantite = GREATEST(quantite + ". $nombre. ", 0) WHERE id = ". $id;

        $res = $this->_db->query($requete);
        
		return $res;


	}
	/**
	 * Fonction qui change la quantité d'une bouteille en particulier dans le cellier
	 */
	public function modifierQuantiteBouteilleCellierSAQ($id, $nombre)
	{

		$requete = "UPDATE vino__bouteille_saq SET quantite = GREATEST(quantite + ". $nombre. ", 0) WHERE id = ". $id;

        $res = $this->_db->query($requete);
        
		return $res;


	}

/**
 * Fonction qui obtien bouteille prive
 */
	public function getBouteilleCellier($id)
	{
		$requete = "SELECT * FROM vino__bouteille_prive WHERE id = $id";
		$data = $this->_db->query($requete);
		$row = $data->fetch_assoc();
		
		return $row;
	}

		/**
		 * Fonction qui modifie une bouteille prive
		 */
		public function modifierBouteilleCellier($data)	
		{

			$id = $data->id;
			$requete = "UPDATE 	`vino__bouteille_prive` SET 
								`id_cellier`='".$data->id_cellier."', 
								`id_type`='".$data->id_type."', 
								`nom`='".$data->nom."', 
								`pays`='".$data->pays."', 
								`date_achat`='".$data->date_achat."',
								`garde_jusqua`='".$data->garde_jusqua."', 
								`notes`='".$data->notes."',
								`prix_achat`='".$data->prix_achat."',
								`quantite`='".$data->quantite."',
								`millesime`='".$data->millesime."' WHERE id = $id";
								
			$res = $this->_db->query($requete);
			
			return $res;
	
		} 

		/**
		 * Fonction qui obtien les bouteille saq
		 */
	public function getBouteilleCelliersaq($id)
	{
		$requete = "SELECT * FROM vino__bouteille_saq WHERE id = $id";
		$data = $this->_db->query($requete);
		$row = $data->fetch_assoc();
		
		return $row;
	}
		/**
		 * Fonction qui modifie une bouteille saq
		 */
		public function modifierBouteilleCelliersaq($data)	
		{
			var_dump($data);
			$id = $data->id;
			$requete = "UPDATE 	`vino__bouteille_saq` SET 
								`id_cellier`='".$data->id_cellier."', 
								`date_achat`='".$data->date_achat."',
								`garde_jusqua`='".$data->garde_jusqua."', 
								`notes`='".$data->notes."',
								`millesime`='".$data->millesime."' WHERE id = $id";
								
			$res = $this->_db->query($requete);
			
			return $res;
	
		} 

/* public function getListeBouteilleCellier()
	{
		
		$rows = Array();
		$requete ='SELECT 
						c.id as id_bouteille_cellier,
						c.id_bouteille, 
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
						from vino__cellier c 
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
	} */


/* 	public function getListeBouteilleCellier($id)
	{
		
		$rows = Array();
		$res = $this->_db->query('SELECT * FROM vino__bouteille_saq WHERE id_cellier = ' . $id);
		if($res->num_rows)
		{
			while($row = $res->fetch_assoc())
			{
				$rows[] = $row;
			}
		}
		
		return $rows;
	} */

/* 	public static function getListeBouteilleCellier($id)
    {
        $db = static::getDB();
        $sql = 'SELECT * FROM vino__bouteille_saq WHERE id_cellier = ' . $id;
        $stmt = $db->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } */

}




?>