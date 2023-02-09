<?php
session_start();

class Controler
{

	/**
	 * Traite la requête
	 * @return void
	 */
	public function gerer()
	{
		if (isset($_GET['id'])) $id = $_GET['id'];

		switch ($_GET['requete']) {
				/* case 'listeBouteille':
				$this->listeBouteille();
				break; */
			case 'autocompleteBouteille':
				$this->autocompleteBouteille();
				break;
			case 'ajouterNouvelleBouteilleCellier':
				$this->ajouterNouvelleBouteilleCellier();
				break;
			case 'ajouterBouteilleCellier':
				$this->ajouterBouteilleCellier();
				break;
			case 'boireBouteilleCellier':
				$this->boireBouteilleCellier();
				break;

			case 'ajouterBouteilleCellierSAQ':
				$this->ajouterBouteilleCellierSAQ();
				break;
			case 'boireBouteilleCellierSAQ':
				$this->boireBouteilleCellierSAQ();
				break;
			case 'profil':
				$this->profil();
				break;
			case 'profilmod':
				$this->profilmod();
				break;
			case 'register':
				$this->register();
				break;
			case 'login':
				$this->login();
				break;
			case 'deconnexion':
				$this->deconnexion();
				break;
		/* 	case 'cellier':
				$this->cellier();
				break; */
			case 'cellierid':
				$this->cellierid($id);
				break;
			case 'listecellier':
				$this->listecellier();
				break;
			case 'ajoutercellier':
				$this->ajoutercellier();
				break;
			case 'ajouterNouvelleBouteilleCellierPrive':
				$this->ajouterNouvelleBouteilleCellierPrive();
				break;
			case 'deleteprive':
				$this->deleteprive();
				break;
			case 'deleteSAQ':
				$this->deleteSAQ();
				break;
			case 'deletecellier':
				$this->deletecellier();
				break;

				//yordan
			case "getBouteille":
				$this->getBouteille($id);
				break;
			case "getBouteillesaq":
				$this->getBouteillesaq($id);
				break;
			case "modifierBouteilleCellier":
				$this->modifierBouteilleCellier();
				break;
			case "modifierBouteilleCelliersaq":
				$this->modifierBouteilleCelliersaq();
				break;


			default:
				$this->accueil();
				break;
		}
	}

/**
 * Fonction qui affiche l'accueil
 */
	private function accueil()
	{
		include("vues/entete.php");
		include("vues/accueil.php");
		include("vues/pied.php");
	}
/**
 * Fonction qui affiche le profil
 */
	private function profil()
	{
		include("vues/entete.php");
		include("vues/profil.php");
		include("vues/pied.php");
	}

	/**
	 * Fonction qui modifie le profile
	 */
	private function profilmod()
	{
		if (!empty($_POST)) {
			$user = new Usager();
			$user->updateProfil($_POST);
			$_SESSION['usager'][0]['nom'] = $_POST['nom'];
			header("Location: " . BASEURL . "?requete=profil");
			exit();
		}
		include("vues/entete.php");
		include("vues/profilmod.php");
		include("vues/pied.php");
	}

	/**
	 * Fonction qui ajoute un usager
	 */
	private function register()
	{
		if (!empty($_POST)) {
			$user = new Usager();
			$user->addUtilisateur($_POST);
			header("Location: " . BASEURL . "?requete=login");
			exit();
		}
		include("vues/entete.php");
		include("vues/register.php");
		include("vues/pied.php");
	}

	/**
	 * Fonction qui connecte l'usager
	 */
	private function login()
	{
		if (!empty($_POST)) {
			$erreur = false;
			$email = $_POST['email'];
			$mdp = $_POST['mdp'];
			$user = new Usager();
			$usager = $user->unUsager($email);

			if (!$usager || !password_verify($mdp, $usager[0]['mdp'])) {

				$erreur = "Combinaison courriel/mot de passe erronée";
			}

			if (!$erreur) {
				$_SESSION['usager'] = $usager;
				header("Location: " . BASEURL . "?requete=listecellier");
				exit();
			}
		}
		include("vues/entete.php");
		include("vues/login.php");
		include("vues/pied.php");
	}
/**
 * Fonction qui déconnecte l'usager
 */
	public function deconnexion()
	{
		unset($_SESSION['usager']);
		include("vues/entete.php");
		include("vues/accueil.php");
		include("vues/pied.php");
	}
/**
 * Fonction qui affiche le cellier
 */
/* 	private function cellier()
	{
		if (!empty($_POST)) {

			$id_cellier = $_POST['id'];
			$cellier = new Cellier();
			$datacell = $cellier->getCellier($id_cellier);
			$bte = new Bouteille();
			$data = $bte->getListeBouteilleSAQ($id_cellier);
			$dataprive = $bte->getListeBouteillePrive($id_cellier);
		}
		include("vues/entete.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	} */
	/**
	 * Fonction qui supprime une bouteille prive
	 */
	private function deleteprive()
	{
		if (!empty($_POST)) {

			$id_bouteille = $_POST['id'];
			$bte = new Bouteille();
			$bte->deleteprive($id_bouteille);
			$succes = 'Bravo!';
			$id_cellier = $_GET['id'];
			$cellier = new Cellier();
			$datacell = $cellier->getcellier($id_cellier);
		}
		include("vues/entete.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	}
/**
 * Fonction qui supprime une bouteille de la saq
 */
	private function deleteSAQ()
	{
		if (!empty($_POST)) {

			$id_bouteille = $_POST['id'];
			$bte = new Bouteille();
			$bte->deleteSAQ($id_bouteille);
			$succes = 'Bravo!';
			$id_cellier = $_GET['id'];
			$cellier = new Cellier();
			$datacell = $cellier->getcellier($id_cellier);
		}
		include("vues/entete.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	}
/**
 * Fonction qui supprime le cellier et ces bouteilles
 */
	private function deletecellier()
	{
		if (!empty($_POST)) {
			$id_cellier = $_POST['id'];
			$cellier = new Cellier();
			$cellier->deletecellier($id_cellier);
			$cellier->deletebteprive($id_cellier);
			$cellier->deletebtesaq($id_cellier);
			header("Location: " . BASEURL . "?requete=listecellier");
			exit();
		}
	}
/**
 * Fonction qui affiche les celliers
 */
	private function listecellier()
	{
		$id_usager = $_SESSION['usager'][0]['id'];
		$cellier = new Cellier();
		$data = $cellier->getListeCelliers($id_usager);
		//echo json_encode($data);           
		include("vues/entete.php");
		include("vues/listecellier.php");
		include("vues/pied.php");
	}
/**
 * Fonction qui ajoute un cellier
 */
	private function ajoutercellier()
	{
		if (!empty($_POST)) {
			$celier = new Cellier();
			$celier->ajouterCellier($_POST);
			// Afficher liste des celliers
			header("Location: " . BASEURL . "?requete=listecellier");
		} else {
			include("vues/entete.php");
			include("vues/ajoutcellier.php");
			include("vues/pied.php");
		}
	}

	/**
	 * Fonction qui ajoute une bouteille saq
	 */
	private function ajouterNouvelleBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
		//var_dump($body);
		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->ajouterBouteilleCellier($body);
			echo json_encode($resultat);
		} else {
			$cellier = new Cellier();
			$id_usager = $_SESSION['usager'][0]['id'];
			$data = $cellier->getListeCelliers($id_usager);
			include("vues/entete.php");
			include("vues/ajouter.php");
			include("vues/pied.php");
		}
	}

	/**
	 * Fonction qui ajoute une bouteille prive
	 */
	private function ajouterNouvelleBouteilleCellierPrive()
	{
		if (!empty($_POST)) {

			$bte = new Bouteille();
			$bte->ajouterBouteilleCellierPrive($_POST);
			$id_cellier = $_GET['id'];
			$cellier = new Cellier();
			$datacell = $cellier->getcellier($id_cellier);
			$succes = 'Bravo!';
			include("vues/entete.php");
			include("vues/ajouterprive.php");
			include("vues/pied.php");
		} else {
			$id_cellier = $_GET['id'];
			$cellier = new Cellier();
			$datacell = $cellier->getcellier($id_cellier);
			$bte = new Bouteille();
			$datatype =  $bte->getListeType();
			include("vues/entete.php");
			include("vues/ajouterprive.php");
			include("vues/pied.php");
		}
	}

	/* 	private function listeBouteille()
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier();
		echo json_encode($cellier);
	} */

	/**
	 * Fonction qui autocomplete la recherche du nom de la bouteille saq
	 */
	private function autocompleteBouteille()
	{
		$bte = new Bouteille();
		//var_dump(file_get_contents('php://input'));
		$body = json_decode(file_get_contents('php://input'));
		//var_dump($body);
		$listeBouteille = $bte->autocomplete($body->nom);
		echo json_encode($listeBouteille);
	}
/**
 * Fonction qui diminue la quantitée de bouteille prive
 */
	private function boireBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
		echo json_encode($resultat);
	}

	/**
	 * Fonction qui augmente la quantitée de bouteille prive
	 */
	private function ajouterBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
		echo json_encode($resultat);
	}
	/**
 * Fonction qui diminue la quantitée de bouteille saq
 */
	private function boireBouteilleCellierSAQ()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellierSAQ($body->id, -1);
		echo json_encode($resultat);
	}
	/**
	 * Fonction qui augmente la quantitée de bouteille saq
	 */
	private function ajouterBouteilleCellierSAQ()
	{
		$body = json_decode(file_get_contents('php://input'));

		$bte = new Bouteille();
		$resultat = $bte->modifierQuantiteBouteilleCellierSAQ($body->id, 1);
		echo json_encode($resultat);
	}

/**
 * Fonction qui affiche le formulaire modifier bouteille prive
 */
	private function getBouteille($id)
	{
		$bte = new Bouteille();
		$data = $bte->getBouteilleCellier($id);
		$id_usager = $_SESSION['usager'][0]['id'];
		$cellier = new Cellier();
		$datacell = $cellier->getListeCelliers($id_usager);
		$bte = new Bouteille();
		$datatype =  $bte->getListeType();
		include("vues/entete.php");
		include("vues/modifier.php");
		include("vues/pied.php");
	}

	/**
 * Fonction qui affiche le formulaire modifier bouteille saq
 */
	private function getBouteillesaq($id)
	{
		$bte = new Bouteille();
		$data = $bte->getBouteilleCelliersaq($id);
		$id_usager = $_SESSION['usager'][0]['id'];
		$cellier = new Cellier();
		$datacell = $cellier->getListeCelliers($id_usager);
		$bte = new Bouteille();
		$datatype =  $bte->getListeType();
		include("vues/entete.php");
		include("vues/modifiersaq.php");
		include("vues/pied.php");
	}

/**
 * Fonction qui affiche le cellier
 */
	private function cellierid($id)
	{
		$id_cellier = $_GET['id'];
		$cellier = new Cellier();
		$datacell = $cellier->getCellier($id_cellier);
		$bte = new Bouteille();
		$data = $bte->getListeBouteilleSAQ($id_cellier);
		//var_dump($data);
		$dataprive = $bte->getListeBouteillePrive($id_cellier);
		include("vues/entete.php");
		include("vues/cellier.php");
		include("vues/pied.php");
	}
/**
 * Fonction qui modifie une bouteille prive
 */
	private function modifierBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));
		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->modifierBouteilleCellier($body);
			echo json_encode($resultat);
			header("Location: " . BASEURL . "?requete=listecellier");
			exit();
		} else {
			include("vues/entete.php");
			include("vues/modifier.php");
			include("vues/pied.php");
		}
	}
/**
 * Fonction qui modifie une bouteille saq
 */
	private function modifierBouteilleCelliersaq()
	{
		$body = json_decode(file_get_contents('php://input'));
		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->modifierBouteilleCelliersaq($body);
			echo json_encode($resultat);
			header("Location: " . BASEURL . "?requete=listecellier");
			exit();
		} else {
			include("vues/entete.php");
			include("vues/modifiersaq.php");
			include("vues/pied.php");
		}
	}
}
