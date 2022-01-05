<?php namespace App\Controllers;
use App\Models\mUtilisateur;

class cUtilisateur extends BaseController
{
	public function __construct()
	{}
	
	public function __destruct()
	{}

	public function create_utilisateur()
	{
		if ($this->request->getMethod() === 'post')
		{
			date_default_timezone_set('Europe/Paris');
			if ($this->request->getPost('mdp') == $this->request->getPost('cmdp'))
			{
				if (model('mUtilisateur')->erreur_inscription($this->request->getPost('email'),$this->request->getPost('login')))
				{
					$data['exists'] = "Le login ou l'adresse email existe déjà !";
					echo view('templates/header', $data);
					echo view('Inscription', $data);
					echo view('templates/footer', $data);
				}
				else
				{
					$utilisateur = array(
					'U_mail' => $this->request->getPost('email'),
					'U_mdp' => sha1($this->request->getPost('mdp')),
					'U_pseudo' => $this->request->getPost('login'),
					'U_nom' => $this->request->getPost('nom'),
					'U_prenom' => $this->request->getPost('prenom'),
					'U_date_inscription' => date("Y-m-d H:i:s")
					);
					model('mUtilisateur')->create($utilisateur);
					return redirect()->to(''.base_url().'/Connexion');
				}
			}
			else
			{
				$data['exists'] = "Les mots de passes sont différents !";
				echo view('templates/header', $data);
				echo view('Inscription', $data);
				echo view('templates/footer', $data);
			}
		}
		else
		{
			return redirect()->to(''.base_url().'/Inscription');
        }
    }

	public function display_utilisateur()
	{	
		if ($this->request->getMethod() === 'post')
		{
			if (model('mUtilisateur')->test_connexion($this->request->getPost('alogin'),$this->request->getPost('amdp')))
			{
				$session = \Config\Services::session(); //Création de la session
				$session->set('email', $this->request->getPost('alogin'));
				$session->set('login', model('mUtilisateur')->get_pseudo($this->request->getPost('alogin')));
				return redirect()->to(''.base_url().'/');
			}
			else
			{
				$data['erreur_connexion'] = "Login ou mot de passe incorrect";
				echo view('templates/header', $data);
				echo view('Connexion',$data);
				echo view('templates/footer', $data);
			}
		}
	}

	public function update_utilisateur()
	{
		if ($this->request->getMethod() === 'post')
		{
			$session = \Config\Services::session();
			$update = array();
			if (empty($this->request->getPost('amdp')) && empty($this->request->getPost('nmdp')) && empty($this->request->getPost('cnmdp')))
			{
				if (!empty($this->request->getPost('mnom')))
					$update += ['U_nom' => $this->request->getPost('mnom')];
				if (!empty($this->request->getPost('mprenom')))
					$update += ['U_prenom' => $this->request->getPost('mprenom')];
				if (!empty($this->request->getPost('mpseudo')))
					$update += ['U_pseudo' => $this->request->getPost('mpseudo')];
				if (!empty($this->request->getGet('pseudo')))
				{
					model('mUtilisateur')->updater($update,model('mUtilisateur')->get_mail($this->request->getGet('pseudo')));	
					if (!empty($this->request->getPost('mpseudo')))
					{
						model('mMessage')->updater(['M_destinataire' => $this->request->getPost('mpseudo')]);
						model('mMessage')->updater(['U_mail' => model('mUtilisateur')->get_mail($this->request->getPost('mpseudo'))]);
					}
					return redirect()->to(''.base_url().'/AdminComptes/envoimail?pseudo='.$this->request->getGet('pseudo').'&num='.$this->request->getGet('num').'');
				}
				else
				{
					model('mUtilisateur')->updater($update,$session->get('email'));
					if (!empty($this->request->getPost('mpseudo')))
					{
						$session->set('login', $this->request->getPost('mpseudo'));
						model('mMessage')->updater(['M_destinataire' => $this->request->getPost('mpseudo')]);
						model('mMessage')->updater(['U_mail' => model('mUtilisateur')->get_mail($this->request->getPost('mpseudo'))]);
					}
				}
			}
			if(empty($session->get('email')))
				$mail = model('mUtilisateur')->get_mail($this->request->getGet('pseudo'));
			else
				$mail = $session->get('email');
			if (!empty($this->request->getPost('nmdp')) && !empty($this->request->getPost('cnmdp')))
			{
				if(sha1($this->request->getPost('amdp')) == model('mUtilisateur')->get_mdp($mail))
				{
					if($this->request->getPost('nmdp') == $this->request->getPost('cnmdp'))
					{
						model('mUtilisateur')->updater(['U_mdp' => sha1($this->request->getPost('nmdp'))],$mail);
					}
				}
				else
				{
					return redirect()->to(''.base_url().'/gererprofil');		
				}
			}
			return redirect()->to(''.base_url().'/gererprofil');		
		}
		
	}

	public function disconnect()
	{
		$session = \Config\Services::session();
		$session->destroy();
		return redirect()->to(''.base_url().'/Connexion');
	}

	public function delete_utilisateur()
	{
		$session = \Config\Services::session();
		if(!empty($this->request->getGet('pseudo')))
		{
			model('mMessage')->suppression(model('mUtilisateur')->get_mail($this->request->getGet('pseudo')),$this->request->getGet('pseudo'));
			model('mMaison')->suppression(model('mUtilisateur')->get_mail($this->request->getGet('pseudo')));
			model('mUtilisateur')->suppression(['U_pseudo' => $this->request->getGet('pseudo')]);
			if ($this->request->getGet('num') == 2)
				return redirect()->to(''.base_url().'/AdminComptes');
		}
		else
		{
			model('mMessage')->suppression(model('mUtilisateur')->get_mail($session->get('login')),$session->get('login'));
			model('mMaison')->suppression(model('mUtilisateur')->get_mail($session->get('login')));
			model('mUtilisateur')->suppression(['U_pseudo' => $session->get('login')]);
			$session->destroy();
			return redirect()->to(''.base_url().'/Connexion');
		}
	}

	public function bloquer_publication()
	{
		if (model('mUtilisateur')->get_with_pseudo($this->request->getGet('pseudo'))->U_publication == FALSE)
			$update = array('U_publication' => TRUE);
		else
			$update = array('U_publication' => FALSE);
		model('mUtilisateur')->updater($update, model('mUtilisateur')->get_mail($this->request->getGet('pseudo')));
		return redirect()->to(''.base_url().'/AdminComptes/envoimail?pseudo='.$this->request->getGet('pseudo').'&num='.$this->request->getGet('num').'');
	}

	public function envoi_mail()
	{
		$header="MIME-Version: 1.0\r\n";
		$header.='From:"Mon HLM"<A2020M3104G01/PROJET_PHPs/public/>'."\n";
		$header.='Content-Type:text/html; charset="utf-8"'."\n";
		$header.='Content-Transfer-Encoding: 8bit';
		if ((empty($this->request->getPost('Objet'))) && (empty($this->request->getPost('message'))))
		{
			
			switch($this->request->getGet('num'))
			{
				case 1:
					$objet = "Modification du profil";
					$message = "Votre compte a été modifié";
					break;
				case 2:
					$objet = "Suppression du compte";
					$message = "Votre compte a été supprimé";
					break;
				case 3:
					$objet = "Bloquage des annonces";
					$message = "Vous ne pouvez plus ajouter des annonces sur notre site";
					break;
				case 4:
					$objet = "Débloquage des annonces";
					$message = "Vous pouvez désormais ajouter des annonces sur notre site";
					break;
				case 6:
					$objet = "Modification de l'annonce ".model('mMaison')->get_une_annonce($this->request->getGet('id'))->A_titre;
					$message = "L'annonce ".model('mMaison')->get_une_annonce($this->request->getGet('id'))->A_titre." a été modifiée";
					break;
				case 5:
					$objet = "Supression de l'annonce ".model('mMaison')->get_une_annonce($this->request->getGet('id'))->A_titre;
					$message = "L'annonce ".model('mMaison')->get_une_annonce($this->request->getGet('id'))->A_titre." a été supprimée";
					break;
				case 7:
					$objet = "Supression des messages de l'annonces ".model('mMaison')->get_une_annonce($this->request->getGet('id'))->A_titre;
					$message = "Les messages de l'annonce ".model('mMaison')->get_une_annonce($this->request->getGet('id'))->A_titre." ont été supprimées";
					break;
				case 8:
					$objet = "Supression des photos de l'annonces ".model('mMaison')->get_une_annonce($this->request->getGet('id'))->A_titre;
					$message = "Les photos de l'annonce ".model('mMaison')->get_une_annonce($this->request->getGet('id'))->A_titre." ont été supprimées";
					break;
				case 9:
					$objet = "Récupéation du mot de passe";
					$message = 'Cliquez sur ce lien pour récuprérer votre mot de passe : <a href=https://a-pedagoarles-lamp.aix.univ-amu.fr/A2020M3104G01/PROJET_PHPs/public/recupmdp?num='.$this->request->getGet('num').'>Ici</a>';
					break;
				case 10:
					$objet = "Récupéation du mot de passe";
					$message = 'Cliquez sur ce lien pour récuprérer votre mot de passe : <a href=https://a-pedagoarles-lamp.aix.univ-amu.fr/A2020M3104G01/PROJET_PHPs/public/recupmdp?num='.$this->request->getGet('num').'>Ici</a>';
					break;
				default:
					break;
			}
		}
		else
		{
			$objet = $this->request->getPost('Objet');
			$message = $this->request->getPost('message');
		}
		if (!empty($this->request->getGet('pseudo')))
			mail(model('mUtilisateur')->get_with_pseudo($this->request->getGet('pseudo'))->U_mail, $objet, $message, $header);
		else
		{
			if (!empty($this->request->getPost('nemail')) && (model('mUtilisateur')->get_number_of('U_mail',$this->request->getPost('nemail')) > 0))
			{
				mail($this->request->getPost('nemail'), $objet, $message, $header);
				$session = \Config\Services::session(); //Création de la session
				$session->set('recup_mail',$this->request->getPost('nemail'));
			}
			else
			{
				mail(model('mMaison')->get_une_annonce($this->request->getGet('id'))->U_mail, $objet, $message, $header);
			}
		}
		if ($this->request->getGet('num')==2)
			return redirect()->to(''.base_url().'/SupprimerComptes?pseudo='.$this->request->getGet('pseudo').'&num='.$this->request->getGet('num').'');
		else
		{
			if($this->request->getGet('num')==9)
			{
				$data['messageemail'] = 'Un mail pour récupérer le mot de passe est envoyé si le mail existe';
				echo view('templates/header', $data);
				echo view('mdpoublie', $data);
				echo view('templates/footer');
				return redirect()->to(''.base_url().'/mdpoublie');
			}
			else
			{
				return redirect()->to(''.base_url().'/AdminComptes');
			}
		}
			

		
	}

	public function recup_mdp()
	{
		if ($this->request->getMethod() === 'post')
		{
			if($this->request->getPost('nmdp') == ($this->request->getPost('cnmdp')))
			{
				$session = \Config\Services::session(); //Création de la session
				$update = array('U_mdp' => sha1($this->request->getPost('nmdp')));
				model('mUtilisateur')->updater($update,$session->get('recup_mail'));
				$session->set('recup_mail',null);
				$session->destroy();
				return redirect()->to(''.base_url().'/Connexion');
			}
			else
			{
				$data['erreur_mdp'] = "Les mots de passes sont différents";
				echo view('templates/header', $data);
				echo view('recupmdp', $data);
				echo view('templates/footer');
			}
		}
	}


}
