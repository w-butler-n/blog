<?php
	class user extends Controller
	{

        public function inscription($new_user)
        {
        	$sth = $this->bdd->prepare('SELECT login,pwd FROM users WHERE login = :identifiant AND email = :email');
        	$sth->execute(array('identifiant'=>$new_user['identifiant'],'email'=>$new_user['email']));
        	$result = $sth->fetch(PDO::FETCH_ASSOC);

        	if($result === false)
        	{
	        	$stmp = $this->bdd->prepare('INSERT INTO users(login,pwd,telephone,email,naissance,genre,ip,date_inscription,level) 
	        								VALUES(:identifiant,:password,:telephone,:email,:naissance,:genre,:ip,NOW(),:level)');
	        	$stmp->execute(array(
	        						'identifiant'	=>$new_user['identifiant'],
	        						'password'		=>sha1($new_user['password']),
	        						'telephone'		=>$new_user['telephone'],
	        						'email'			=>$new_user['email'],
	        						'naissance'		=>$new_user['jour']."/".$new_user['mois']."/".$new_user['annee'],
	        						'genre'			=>$new_user['genre'],
                                    'level'         =>'utilisateur',
	        						'ip'			=>$_SERVER["REMOTE_ADDR"]
	        					));
	        }
            else 
            {
                return 'cette utilisateur ou email existe deja !!!!';
            }
        }

        public function connexion($conex)
        {
        	$sth = $this->bdd->prepare('SELECT login,pwd,level FROM users WHERE login = :identifiant AND pwd = :password ');
        	$sth->execute(array(
        						'identifiant'=>$conex['identifiant'],
        						'password'=>sha1($conex['password'])
        						));
        	$result = $sth->fetch(PDO::FETCH_ASSOC);
            $stho = $this->bdd->prepare('SELECT id FROM users WHERE login = :identifiant');
            $stho->execute(array(
                                'identifiant'=>$conex['identifiant'],
                                ));
            $recup = $stho->fetch(PDO::FETCH_ASSOC);
            $_SESSION['recup'] = $recup;
        	if($result !== false)
        	{

                $_SESSION['user'] = $conex['identifiant'];

                $stmp = $this->bdd->prepare('INSERT INTO historique_connex(identifiant,ip,date_connex) VALUES(:identifiant,:ip,NOW())');
                $stmp->execute(array(
                                    'identifiant'   =>$_SESSION['user'],
                                    'ip'            =>$_SERVER["REMOTE_ADDR"]
                                ));
                if($result['level'] == 'superadmin' || $result['level'] == 'admin')
                {
                    $_SESSION['level'] = 'admin';
                }
                else if($result['level'] == 'blogger')
                {
                    $_SESSION['level'] = 'blogger';
                }
                else
                {
                    $_SESSION['level'] = 'utilisateur';
                }
        	}
        }

        public function infos_user($identifiant)
        {
            $sth = $this->bdd->prepare('SELECT id,login,telephone,email,naissance,genre,level FROM users WHERE login = :identifiant');
            $sth->execute(array('identifiant'=>$identifiant));
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function oublie_password($email)
        {
            $sth = $this->bdd->prepare('SELECT email FROM users WHERE email = :email');
            $sth->execute(array('email'=>$email['email']));
            $result = $sth->fetch(PDO::FETCH_ASSOC);

            if($result !== false)
            {
                $token = uniqid(rand(), true);
                $_SESSION['token'] = $token;
                $_SESSION['token_time'] = time();
                $result = "Les instruction pour la réinitialisation de votre mot de passe vous ont été envoyé par mail";
            }
            else
            {
                $result = "Cette adresse email ne correspond à aucun comptes enregistrés";
            }
            return $result;
        }

        public function update_infos($infos,$id)
        {
            $sth = $this->bdd->prepare('UPDATE users SET telephone = :telephone,email = :email WHERE id = :id');
            $sth->execute(array('telephone'=>$infos['telephone'],'email'=>$infos['email'],'id'=>$id));
        }
    }
?>
