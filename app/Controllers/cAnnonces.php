<?php namespace App\Controllers;
use App\Models\mMaison;
use App\Models\mUtilsateur;

class cAnnonces extends BaseController
{
	public function __construct()
	{}
	
	public function __destruct()
	{}
	
	public function create_annonce()
	{
		$session = \Config\Services::session();
		if ($this->request->getMethod() === 'post')
		{
				date_default_timezone_set('Europe/Paris');
				if (!empty(model('mMaison')->getIdEnergie($this->request->getPost('individuel'))))
				{
					$annonce = array(
					'A_idannonce' => null,
					'A_titre' => $this->request->getPost('titre'),
					'A_cout_loyer' => $this->request->getPost('location'),
					'A_cout_charges' => $this->request->getPost('charges'),
					'A_type_chauffage' => $this->request->getPost('chauffage'),
					'A_superficie' => $this->request->getPost('superficie'),
					'A_description' => $this->request->getPost('description'),
					'A_adresse' => $this->request->getPost('adresse'),
					'A_ville' => $this->request->getPost('ville'),
					'A_CP' => $this->request->getPost('CP'),
					'A_date' => date("Y-m-d H:i:s"),
					'E_id_engie' => model('mMaison')->getIdEnergie($this->request->getPost('individuel')),
					'T_type' => $this->request->getPost('logement'),
					'U_mail' => model('mUtilisateur')->get_mail($session->get('login')),
					'A_publiee' => true
					);
					
				}
				else
				{
					$annonce = array(
						'A_idannonce' => null,
						'A_titre' => $this->request->getPost('titre'),
						'A_cout_loyer' => $this->request->getPost('location'),
						'A_cout_charges' => $this->request->getPost('charges'),
						'A_type_chauffage' => $this->request->getPost('chauffage'),
						'A_superficie' => $this->request->getPost('superficie'),
						'A_description' => $this->request->getPost('description'),
						'A_adresse' => $this->request->getPost('adresse'),
						'A_ville' => $this->request->getPost('ville'),
						'A_CP' => $this->request->getPost('CP'),
						'A_date' => date("Y-m-d H:i:s"),
						'T_type' => $this->request->getPost('logement'),
						'U_mail' => model('mUtilisateur')->get_mail($session->get('login')),
						'A_publiee' => true
						);
				}
				model('mMaison')->create('T_annonce',$annonce); 
				$images = array('photo1' => $this->request->getFile('image1'), 'photo2' => $this->request->getFile('image2'), 'photo3' => $this->request->getFile('image3'), 'photo4' => $this->request->getFile('image4'), 'photo5' => $this->request->getFile('image5'));
				$existe = false;
				foreach($images as $img):
				{
					if ($img->isValid() && !$img->hasMoved())
					{
						$img->move('images/', $img->getName());
						$photo = array(
						'P_titre' => 'images/'.$img->getName(),
						'P_nom' => 'Une photo',
						'A_idannonce' => model('mMaison')->getMaxIdAnnonce()
						);
						$existe = true;
						model('mMaison')->create('T_photo',$photo);
					}
							
				}endforeach;  
				if (!$existe)
				{
					$photo = array(
						'P_titre' => 'images/placeholder.png',
						'P_nom' => 'Une photo',
						'A_idannonce' => model('mMaison')->getMaxIdAnnonce()
						);
						model('mMaison')->create('T_photo',$photo);
				}				
				return redirect()->to(''.base_url().'/');
		}
		else
		{
			return redirect()->to(''.base_url().'/');
		}

	}

	public function update_annonce(/*$id*/)
	{
		if ($this->request->getMethod() === 'post')
		{
			helper('filesystem');
			date_default_timezone_set('Europe/Paris');
			$session = \Config\Services::session();
			$update = array();
			if (!empty($this->request->getPost('mtitre')))
				$update += ['A_titre' => $this->request->getPost('mtitre')];
			if (!empty($this->request->getPost('mlocation')))
				$update += ['A_cout_loyer' => $this->request->getPost('mlocation')];
			if (!empty($this->request->getPost('mcharges')))
				$update += ['A_cout_charges' => $this->request->getPost('mcharges')];
			if (!empty($this->request->getPost('msuperficie')))
				$update += ['A_superficie' => $this->request->getPost('msuperficie')];
			if (!empty($this->request->getPost('mchauffage')))
				$update += ['A_type_chauffage' => $this->request->getPost('mchauffage')];
			if (!empty($this->request->getPost('mindividuel')))
				$update += ['E_id_engie' => $this->request->getPost('mindividuel')];
			if (!empty($this->request->getPost('madresse')))
				$update += ['A_adresse' => $this->request->getPost('madresse')];
			if (!empty($this->request->getPost('mville')))
				$update += ['A_ville' => $this->request->getPost('mville')];
			if (!empty($this->request->getPost('mCP')))
				$update += ['A_CP' => $this->request->getPost('mCP')];		
			if (!empty($this->request->getPost('mdescription')))
				$update += ['A_description' => $this->request->getPost('mdescription')];		
			$update += ['A_date' => date("Y-m-d H:i:s")];	
			model('mMaison')->updater($update,$this->request->getGet('id'));	
			$images = array('mphoto1' => $this->request->getFile('mimage1'), 'mphoto2' => $this->request->getFile('mimage2'), 'mphoto3' => $this->request->getFile('mimage3'), 'mphoto4' => $this->request->getFile('mimage4'), 'mphoto5' => $this->request->getFile('mimage5'));
			foreach(model('mMaison')->getPhotos($this->request->getGet('id')) as $p) : 
			{
				if (file_exists($p['P_titre']) && $p['P_titre'] != 'images/placeholder.png')
					unlink($p['P_titre']);
			}endforeach;
			foreach($images as $img):
			{
				if ($img->isValid() && !$img->hasMoved())
				{
					$img->move('images/', $img->getName());
					$photo = array(
					'P_titre' => 'images/'.$img->getName(),
					'P_nom' => 'Une photo',
					'A_idannonce' => $this->request->getGet('id')
					);
					model('mMaison')->create('T_photo',$photo);
					echo $this->request->getGet('id');
					//model('mMaison')->update_photo($photo, $this->request->getGet('id'));
				}
							
			}endforeach;  
			if (!empty($this->request->getGet('num')))
				return redirect()->to(''.base_url().'/EnvoiMail?id='.$this->request->getGet('id').'&num='.$this->request->getGet('num'));
			else
				return redirect()->to(''.base_url().'/');

		}
	}

	public function delete_annonce(/*$id*/)
	{
		helper('filesystem');
		foreach(model('mMaison')->getPhotos($this->request->getGet('id')) as $p) : 
		{
			if (file_exists($p['P_titre']))
            	unlink($p['P_titre']);
		}endforeach;
		$photo = array(
			'P_titre' => 'images/placeholder.png',
			'P_nom' => 'Une photo',
			'A_idannonce' => $this->request->getGet('id')
			);
			model('mMaison')->create('T_photo',$photo);
		model('mMaison')->supprimer_une(['A_idannonce' => $this->request->getGet('id')]);	
		model('mMessage')->suppression(model('mMaison')->get_une_annonce($this->request->getGet('id'))->U_mail,model('mMaison')->get_une_annonce($this->request->getGet('id'))->U_pseudo);
		if (!empty($this->request->getGet('num')))	
			return redirect()->to(''.base_url().'/EnvoiMail?id='.$this->request->getGet('id').'&num='.$this->request->getGet('num'));
		else
			return redirect()->to(''.base_url().'/');
	}

	public function changer_etat()
	{
		$update = array('A_publiee' => false);
		model('mMaison')->updater($update,$this->request->getGet('id'));
		return redirect()->to(''.base_url().'/');
	}

	public function delete_all_photos()
	{
		helper('filesystem');
		foreach(model('mMaison')->getPhotos($this->request->getGet('id')) as $p) : 
		{
			if (file_exists($p['P_titre']))
            	unlink($p['P_titre']);
		}endforeach;
		model('mMaison')->delete_photo(['A_idannonce' => $this->request->getGet('id')]);
		$photo = array(
			'P_titre' => 'images/placeholder.png',
			'P_nom' => 'Une photo',
			'A_idannonce' => $this->request->getGet('id')
			);
			model('mMaison')->create('T_photo',$photo);
		return redirect()->to(''.base_url().'/EnvoiMail?id='.$this->request->getGet('id').'&num='.$this->request->getGet('num'));
	}


}
?>