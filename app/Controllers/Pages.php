<?php namespace App\Controllers;
use App\Models\mMaison;

class Pages extends BaseController
{
    public function __construct()
    {}

    public function index()
	{
		return view('Accueil2');
	}

	//--------------------------------------------------------------------
	public function view($page = 'Accueil2')
	{
		$session = \Config\Services::session();
		if ( ! is_file(APPPATH.'/Views/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

        $data['title'] = ucfirst($page); // Capitalize the first letter
		$data['annonces'] = model('mMaison')->get_annonces_accueil();
		$data['admin'] = model('mUtilisateur')->get_admin();
		$data['utilisateurs'] = model('mUtilisateur')->get_all();
		$data['touteannonce'] =  model('mMaison')->get_all_annonces_accueil();
		if (!empty($session->get('login')))
		{
			$data['mesannonces'] = model('mMaison')->get_all_annonces($session->get('login'));
			$data['persomoi'] = model('mUtilisateur')->get_with_pseudo($session->get('login'));	
			$data['messages'] = model('mMessage')->get_all($session->get('login'));
			$data['nombremessages'] = model('mMessage')->get_number($session->get('login'));
			$data['mail'] = model('mUtilisateur')->get_mail($session->get('login'));
			$data['pseudo'] = $session->get('login');
		}
		$data['perso'] = model('mUtilisateur')->get_with_pseudo($this->request->getGet('pseudo'));
		$data['pseudoquelconque'] = $this->request->getGet('pseudo');
		$data['touteannoncepseudo'] = model('mMaison')->get_all_annonces($this->request->getGet('pseudo'));
		$data['destinataire'] = $this->request->getGet('destinataire');
		$data['annonce'] = model('mMaison')->get_une_annonce($this->request->getGet('id'));
		$data['photos'] = model('mMaison')->getPhotos($this->request->getGet('id'));
		$data['conversation'] = model('mMessage')->get_conversation($session->get('email'),$this->request->getGet('id'),model('mUtilisateur')->get_mail($this->request->getGet('destinataire')));
		echo view('templates/header', $data);
		echo view($page, $data);
		echo view('templates/footer');
	}
}

?>