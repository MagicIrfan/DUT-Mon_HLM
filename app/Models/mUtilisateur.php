<?php 
namespace App\Models;
use CodeIgniter\Model;

	class mUtilisateur extends Model	
	{
		public function get($table, $value)
		{
			$query = $this->db->query('SELECT '.$table.' FROM T_utilisateur WHERE '.$table.' LIKE "'.$value.'"');
			return $query->getFirstRow()->$table;
		}

		public function get_with_pseudo($value)
		{
			$query = $this->db->query('SELECT * FROM T_utilisateur WHERE U_pseudo LIKE "'.$value.'"');
			return $query->getFirstRow();
		}

		public function get_number_of($column, $value)
		{
			$query = $this->db->query('SELECT * FROM T_utilisateur WHERE '.$column.' LIKE "'.$value.'"');
			return count($query->getResultArray());
		}

		public function get_all()
		{
			$query = $this->db->query('SELECT * FROM T_utilisateur');
			return $query->getResultArray();
		}

		public function get_mdp($mail)
		{
			$query = $this->db->query('SELECT U_mdp FROM T_utilisateur WHERE U_mail LIKE "'.$mail.'"');
			return $query->getFirstRow()->U_mdp;
		}
		public function get_mail($name)
		{
			$query = $this->db->query('SELECT U_mail FROM T_utilisateur WHERE U_pseudo LIKE "'.$name.'"');
			return $query->getFirstRow()->U_mail;
		}

		public function get_pseudo($mail)
		{
			$query = $this->db->query('SELECT U_pseudo FROM T_utilisateur WHERE U_mail LIKE "'.$mail.'"');
			return $query->getFirstRow()->U_pseudo;
		}

		public function get_admin()
		{
			$query = $this->db->query('SELECT * FROM T_utilisateur ORDER BY U_date_inscription');
			return $query->getFirstRow();
		}

		public function erreur_inscription($email, $login)
		{
			return (model('mUtilisateur')->get_number_of('U_mail',$email) > 0) || (model('mUtilisateur')->get_number_of('U_pseudo',$login) >0);
		}

		public function test_connexion ($mail,$mdp)
		{
			return !empty(model('mUtilisateur')->get('U_mail',$mail)) && model('mUtilisateur')->get_mdp($mail) == sha1($mdp);
		}
		public function create($data) 
		{
			$this->db->table('T_utilisateur')->insert($data);
		}

		public function updater($data,$mail)
		{
			$this->db->table('T_utilisateur')->update($data, "U_mail LIKE '$mail'");
		}

		public function suppression($data)
		{
			$this->db->table('T_utilisateur')->delete($data);
		}
	}
	
?>