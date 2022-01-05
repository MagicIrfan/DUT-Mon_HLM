<?php namespace App\Controllers;
use App\Models\mMaison;
use App\Models\mUtilsateur;
use App\Models\mMessage;

class cMessages extends BaseController
{
	public function __construct()
	{}
	
	public function __destruct()
    {}
    
    public function send_message()
    {
        if ($this->request->getMethod() === 'post')
        {
            date_default_timezone_set('Europe/Paris');
            $session = \Config\Services::session();
            if(empty($this->request->getGet('destinataire')))
            {
                $message = array(
                    'M_idmessage' => null,
                    'A_idannonce' => $this->request->getGet('id'),
                    'U_mail' => model('mUtilisateur')->get_mail($session->get('login')),
                    'M_dateheure_message' => date("Y-m-d H:i:s"),
                    'M_texte_message' => $this->request->getPost('description'),
                    'M_destinataire' => model('mMaison')->getCompteAnnonce($this->request->getGet('id'))->U_pseudo
                );
            }
            else
            {
                $message = array(
                    'M_idmessage' => null,
                    'A_idannonce' => $this->request->getGet('id'),
                    'U_mail' => model('mUtilisateur')->get_mail($session->get('login')),
                    'M_dateheure_message' => date("Y-m-d H:i:s"),
                    'M_texte_message' => $this->request->getPost('description'),
                    'M_destinataire' => $this->request->getGet('destinataire')
                );
            }
            model('mMessage')->create($message);
            return redirect()->to(''.base_url().'/');
        }

    }

    public function delete_all()
    {
        model('mMessage')->suppression(model('mMaison')->get_with_id($this->request->getGet('id'))->U_mail,model('mMaison')->get_with_id($this->request->getGet('id'))->U_pseudo);
        return redirect()->to(''.base_url().'/EnvoiMail?id='.$this->request->getGet('id').'&num='.$this->request->getGet('num'));
    }

    public function set_lu()
    {
        if (model('mMessage')->get_une($this->request->getGet('idm'))->M_lu == false)
            $update = array('M_lu' => true);
        model('mMessage')->updater($update, 'M_idmessage = '.$this->request->getGet('idm'));
        return redirect()->to(''.base_url().'/Conversation?id='.$this->request->getGet('id').'&destinataire='.$this->request->getGet('destinataire'));
    }

}