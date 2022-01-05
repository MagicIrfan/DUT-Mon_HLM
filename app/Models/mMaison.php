<?php 
	namespace App\Models;
	use CodeIgniter\Model;
	class mMaison extends Model	
	{
		public function get_all_annonces($pseudo = null)
		{
			$requete = 'SELECT * FROM T_annonce INNER JOIN T_utilisateur ON T_annonce.U_mail = T_utilisateur.U_mail';
			if (isset($pseudo))
				$requete .= ' WHERE U_pseudo LIKE "'.$pseudo.'"';
			$requete .= ' ORDER BY A_date DESC';
			$query = $this->db->query($requete);
			return $query->getResultArray();
		}

		public function get_number($pseudo)
		{
			$query = $this->db->query('SELECT DISTINCT  FROM T_photos INNER JOIN T_annonce ON T_photos.A_idannonce = T_photos.A_idannonce WHERE U_pseudo LIKE "'.$pseudo.'" ORDER BY A_date DESC');
			return count($query->getResultArray());
		}

		public function get_six_annonces()
		{
			$query = $this->db->query('SELECT * FROM T_annonce INNER JOIN T_utilisateur ON T_annonce.U_mail = T_utilisateur.U_mail WHERE A_publiee = TRUE ORDER BY A_date DESC LIMIT 6');
			return $query->getResultArray();
		}

		public function get($table,$colonne,$value) 
		{
			$query = $this->db->query('SELECT '.$colonne.' FROM '.$table.' WHERE '.$colonne.' LIKE "'.$value.'"');
			return $query->getFirstRow()->$colonne;
		}

		public function get_une_annonce($ida)
		{
			$query = $this->db->query("SELECT * FROM T_annonce INNER JOIN T_utilisateur ON T_annonce.U_mail = T_utilisateur.U_mail WHERE T_annonce.A_idannonce = $ida AND A_publiee = TRUE");
			return $query->getFirstRow();
		}

		public function getIdEnergie($value)
		{
			return $this->db->query('SELECT E_id_engie FROM T_Energie WHERE E_description LIKE "'.$value.'"')->getFirstRow()->E_id_engie;
		}

		public function getMaxIdAnnonce()
		{
			return $this->db->table('T_annonce')->selectMax('A_idannonce')->get()->getFirstRow()->A_idannonce;
		}

		public function getCompteAnnonce($ida)
		{
			$query = $this->db->query('SELECT * FROM T_annonce INNER JOIN T_utilisateur ON T_annonce.U_mail = T_utilisateur.U_mail WHERE A_idannonce = '.$ida.'');
			return $query->getFirstRow();
		}

		public function getPhotos($ida)
		{
			$query = $this->db->query('SELECT * FROM T_photo WHERE A_idannonce = '.$ida.'');
			return $query->getResultArray();
		}

		public function getUnePhoto($ida)
		{
			$query = $this->db->query('SELECT * FROM T_photo WHERE A_idannonce = '.$ida.'');
			return $query->getFirstRow()->P_titre;
		}

		public function create($table, $data) 
		{
			$this->db->table($table)->insert($data);
		}

		public function updater($data,$id)
		{
			$this->db->table('T_annonce')->update($data, "A_idannonce = $id");
		}

		public function update_photo($data,$id)
		{
			$this->db->table('T_photo')->update($data, "A_idannonce = $id");
		}

		public function suppression($mail)
		{
			$titres = $this->db->query("SELECT * FROM T_photo INNER JOIN T_annonce ON T_photo.A_idannonce=T_annonce.A_idannonce WHERE U_mail = '$mail'");
			foreach($titres->getResultArray() as $row):
			{
				$this->db->table('T_photo')->delete(['A_idannonce' => $row['A_idannonce']]);
			}endforeach;
			$this->db->table('T_annonce')->delete(['U_mail' => $mail]);
		}

		public function supprimer_une($data)
		{
			$this->db->table('T_photo')->delete($data);
			$this->db->table('T_annonce')->delete($data);
		}

		public function delete_photo($data)
		{
			$this->db->table('T_photo')->delete($data);
		}

		public function get_annonces_accueil()
		{
			$annonce = array();
			$query = $this->db->query('SELECT * FROM T_annonce INNER JOIN T_utilisateur ON T_annonce.U_mail = T_utilisateur.U_mail WHERE A_publiee = TRUE ORDER BY A_date DESC LIMIT 6');		
			foreach ($query->getResultArray() as $row)
			{
				$query2 = $this->db->query('SELECT * FROM T_photo WHERE A_idannonce = '.$row['A_idannonce'].'');		
				$row['image'] = $query2->getFirstRow()->P_titre;
				$annonce[] = $row;
			}
			return $annonce;
		}
		public function get_all_annonces_accueil()
		{
			$requete = 'SELECT * FROM T_annonce INNER JOIN T_utilisateur ON T_annonce.U_mail = T_utilisateur.U_mail WHERE A_publiee = TRUE ORDER BY A_date DESC';
			$query = $this->db->query($requete);
			$annonce = array();
			foreach ($query->getResultArray() as $row)
			{
				$query2 = $this->db->query('SELECT * FROM T_photo WHERE A_idannonce = '.$row['A_idannonce'].'');		
				$row['image'] = $query2->getFirstRow()->P_titre;
				$annonce[] = $row;
			}
			return $annonce;
		}

		public function get_with_id($id)
		{
			$query = $this->db->query("SELECT * FROM T_utilisateur INNER JOIN T_annonce ON T_utilisateur.U_mail=T_annonce.U_mail WHERE A_idannonce = $id");
			return $query->getFirstRow();
		}

	}
?>