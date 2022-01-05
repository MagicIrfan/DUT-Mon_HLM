<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	class mMessage extends Model	
	{
		function __construct()
		{
			parent::__construct();
		}

		public function get_all($account)
		{
			$query = $this->db->query('SELECT * FROM T_message INNER JOIN T_annonce ON T_message.A_idannonce=T_annonce.A_idannonce INNER JOIN T_utilisateur ON T_message.U_mail = T_utilisateur.U_mail WHERE M_destinataire LIKE "'.$account.'" ORDER BY M_lu DESC');
			return $query->getResultArray();
		}

		public function get_destinataire($id,$mail)
		{
			$query = $this->db->query('SELECT M_destinataire FROM T_message INNER JOIN T_annonce ON T_message.A_idannonce=T_annonce.A_idannonce INNER JOIN T_utilisateur ON T_message.U_mail = T_utilisateur.U_mail WHERE T_message.U_mail LIKE "'.$mail.'" AND T_message.A_idannonce = '.$id.' ');
			return $query->getFirstRow()->M_destinataire;
		}

		public function get_conversation($mail,$id,$destinataire)
		{
			$query = $this->db->query('SELECT * FROM T_message INNER JOIN T_annonce ON T_message.A_idannonce=T_annonce.A_idannonce INNER JOIN T_utilisateur ON T_message.U_mail = T_utilisateur.U_mail WHERE T_message.U_mail LIKE "'.$destinataire.'" OR T_message.U_mail LIKE "'.$mail.'" AND T_message.A_idannonce = "'.$id.'" ORDER BY M_dateheure_message');
			return $query->getResultArray();
		}

		public function get_number($account)
		{
			$query = $this->db->query('SELECT * FROM T_message INNER JOIN T_annonce ON T_message.A_idannonce=T_annonce.A_idannonce INNER JOIN T_utilisateur ON T_message.U_mail = T_utilisateur.U_mail WHERE M_destinataire LIKE "'.$account.'" WHERE M_lu = 0');
			return count($query->getResultArray());
		}

		public function get_une($id)
		{
			$query = $this->db->query('SELECT * FROM T_message INNER JOIN T_annonce ON T_message.A_idannonce=T_annonce.A_idannonce INNER JOIN T_utilisateur ON T_message.U_mail = T_utilisateur.U_mail WHERE A_idmessage = '.$id.'');
			return $query->getFirstRow();
		}

		public function create($data)
		{
			$this->db->table('T_message')->insert($data);
		}

		public function updater($data, $modif = null)
		{
			if (!isset($modif))
				$this->db->table('T_message')->update($data);
			else
				$this->db->table('T_message')->update($data, $modif);

		}

		public function suppression($mail, $pseudo)
		{
			$this->db->table('T_message')->delete("U_mail LIKE '$mail' OR M_destinataire LIKE '$pseudo'");
		}
	}
?>