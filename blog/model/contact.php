<?php
	class contact extends Controller
	{
		public function add_contact($infos)
		{
			$sth = $this->bdd->prepare('INSERT INTO contact(nom,prenom,email,sujet,message,date_contact,ip) VALUES(:nom,:prenom,:email,:sujet,:message,NOW(),:ip)');
			$sth->execute(array('nom'=>$infos['nom'],'prenom'=>$infos['prenom'],'email'=>$infos['email'],'sujet'=>$infos['sujet'],'message'=>$infos['message'],'ip'=>$_SERVER['REMOTE_ADDR']));
		}

		public function select_mail()
		{
			$sth = $this->bdd->prepare('SELECT * FROM contact');
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function recup_mail_by_id($id)
		{
			$sth = $this->bdd->prepare('SELECT nom,prenom,message FROM contact WHERE id = :id');
			$sth->execute(array('id'=>$id));
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
	}


?>