<?php
session_start();

/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler 
{
	
	const URL_LOCATION = "http://localhost/vino_etu_renaud_v1";

		/**
		 * Traite la requête
		 * @return void
		 */
		public function gerer()
		{
			
			switch ($_GET['requete']) {
				case 'listeBouteille':
					$this->listeBouteille();
					break;
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
				
				case 'login':
					$this->login();
					break;
				case 'register':
					$this->register();
					break;

				case 'cellier':
					$this->cellier();
					break;
				case 'listecellier':
					$this->getListeCelliers();
					break;
				case 'ajouterCellier':
					$this->ajouterCellier();
					break;
				
				case 'deconnexion':
					$this->deconnexion();
					break;


				default:
					$this->accueil();
					break;
			}
		}

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
						var_dump($erreur);
					
					}
		
					if (!$erreur) {
						$_SESSION['usager'] = $usager;
						header("Location: ".self::URL_LOCATION);
						exit(); 
					}
				}
			
			include("vues/entete.php");
			include("vues/login.php");
			include("vues/pied.php");
		}

		public function deconnexion()
		{
			unset($_SESSION['usager']);
			include("vues/entete.php");
			include("vues/accueil.php");
			include("vues/pied.php");
		}

		private function register()
		{
			if (!empty($_POST)) {
				$user = new Usager();
				$user->addUtilisateur($_POST);
				 header("Location: ".self::URL_LOCATION."/?requete=login");
				exit();
			}
			include("vues/entete.php");
			include("vues/register.php");
			include("vues/pied.php");
                  
		}

		private function accueil()
		{
			include("vues/entete.php");
			include("vues/accueil.php");
			include("vues/pied.php");
                  
		}
		
		private function cellier()
		{
			$bte = new Bouteille();
            $data = $bte->getListeBouteilleCellier();
			 //var_dump($data);
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
                  
		}

		private function getListeCelliers()
		{
			// TODO :  Hard coded
			$id_usager = 3;
			$celier = new Cellier();
            $data = $celier->getListeCelliers($id_usager);

            //echo json_encode($data);

			include("vues/entete.php");
			include("vues/listecellier.php");
			include("vues/pied.php");
		}
		
		private function ajouterCellier()
		{
			if (!empty($_POST)) {
				$celier = new Cellier();
				$celier->ajouterCellier($_POST);

				// Afficher liste des celliers
				header("Location: ".self::URL_LOCATION."/?requete=listecellier");
			}
			else
			{
			include("vues/entete.php");
			include("vues/ajoutcellier.php");
			include("vues/pied.php");
			}
		}
		
		private function listeBouteille()
		{
			$bte = new Bouteille();
            $cellier = $bte->getListeBouteilleCellier();
            
            echo json_encode($cellier);
                  
		}
		
		private function autocompleteBouteille()
		{
			$bte = new Bouteille();
			//var_dump(file_get_contents('php://input'));
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
            $listeBouteille = $bte->autocomplete($body->nom);
            
            echo json_encode($listeBouteille);
                  
		}

		private function ajouterNouvelleBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
			if(!empty($body)){
				$bte = new Bouteille();
				$resultat = $bte->ajouterBouteilleCellier($body);
				echo json_encode($resultat);
			}
			else{
				include("vues/entete.php");
				include("vues/ajouter.php");
				include("vues/pied.php");
			}
		}
		
		private function boireBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
			echo json_encode($resultat);
		}

		private function ajouterBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
			echo json_encode($resultat);
		}
		
}
