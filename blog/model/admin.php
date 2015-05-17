<?php
	class admin extends Controller
	{

		public function recuperation_user($id)
		{
			if(!isset($id))
			{
				$indice = 1;
				$pagination = 20;
				$limite = ($indice - 1) * $pagination;
			}
			
			if(isset($id) && is_numeric($id))
			{
				$indice = $id;
				$pagination = 20;
				$limite = ($indice - 1) * $pagination;
			}

			$sth = $this->bdd->prepare('SELECT * FROM users LIMIT '.$limite.','.$pagination.'');
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		public function recup_user_by_name($name)
		{
			$sth = $this->bdd->prepare('SELECT * FROM users WHERE login = :identifiant');
			$sth->execute(array('identifiant'=>$name));
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		public function delete_user($id_user)
		{
			$sth = $this->bdd->prepare('DELETE FROM users WHERE id = :id');
			$sth->execute(array('id'=>$id_user));
		}

		public function update_user($update,$id)
		{
			$sth = $this->bdd->prepare('UPDATE users SET login = :identifiant,telephone = :telephone,email = :email,naissance = :naissance,genre = :genre,level = :level WHERE id = :id');
			$sth->execute(array('identifiant'	=>$update['identifiant'],
								'telephone'		=>$update['telephone'],
								'email'			=>$update['email'],
								'naissance'		=>$update['naissance'],
								'genre'			=>$update['genre'],
								'level'			=>$update['level'],
								'id'			=>$id
								));
		}

		public function ajout_article($article,$image)
		{
			if(!empty($image))
			{
				$stmp = $this->bdd->prepare('INSERT INTO article(id_user,title,content,image,tags,ip,created,login) 
	        								VALUES(:id_user,:title,:contenu,:image,:genre,:ip,NOW(),:utilisateur)');
		        $stmp->execute(array(
		        					'id_user'=>$_SESSION['recup']['id'],
		        					'title'=>$article['titre'],
		        					'contenu'=>$article['contenu'],
		        					'image'=>$image,
		        					'genre'=>$article['genre_article'],
		        					'ip'=>$_SERVER['REMOTE_ADDR'],
		        					'utilisateur'=>$_SESSION['user']
		        				));
		       
			}

			else if(!empty($article['video']))
			{
				$stmp = $this->bdd->prepare('INSERT INTO article(title,content,video,tags,ip,created,login) 
	        								VALUES(:titre,:contenu,:video,:genre,:ip,NOW(),:utilisateur)');
		        $stmp->execute(array(
		        					'title'=>$article['titre'],
		        					'contenu'=>$article['contenu'],
		        					'video'=>$article['video'],
		        					'genre'=>$article['genre_article'],
		        					'ip'=>$_SERVER['REMOTE_ADDR'],
		        					'utilisateur'=>$_SESSION['user']
		        				));
			}
		}

		public function recup_article($id)
		{
			if(!isset($id))
			{
				$indice = 1;
				$pagination = 6;
				$limite = ($indice - 1) * $pagination;
			}
			
			if(isset($id) && is_numeric($id))
			{
				$indice = $id;
				$pagination = 6;
				$limite = ($indice - 1) * $pagination;
			}

			$sth = $this->bdd->prepare('SELECT * FROM article LIMIT '.$limite.','.$pagination.'');
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		}

		public function recup_article_by_id($id)
		{
			$sth = $this->bdd->prepare('SELECT * FROM article WHERE id = :id');
			$sth->execute(array('id'=>$id));
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		public function update_article($update,$image,$id)
		{
			$sth = $this->bdd->prepare('UPDATE article SET title = :titre,content = :contenu,image = :image,tags = :genre,updated = NOW() WHERE id = :id');
			$sth->execute(array('titre'	=>	$update['titre'],
								'contenu'		=>$update['contenu'],
								'image'			=>$image,
								'genre'			=>$update['genre'],
								'id'			=>$id
								));
		}

		public function recup_image_by_id($id)
		{
			$sth = $this->bdd->prepare('SELECT image FROM article WHERE id = :id');
			$sth->execute(array('id'=>$id));
			$result = $sth->fetch(PDO::FETCH_ASSOC);

			return $result;
		}

		public function pagination()
		{
			$pagination = 6;
			$sth = $this->bdd->prepare('SELECT title FROM article');
			$sth->execute();
			$result = $sth->fetchall(PDO::FETCH_ASSOC);
			$nb_total = count($result);
			$nb_pages = ceil($nb_total / $pagination);
			
			return $nb_pages;
		}

		public function pagination_lien_suivant($id)
		{
			if(isset($id) && $id < $this->pagination())
			{
				$page_suivante = $id + 1;
				$lien_suivant = '<a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/article/page/'.$page_suivante.'>suivant</a>';
				return $lien_suivant;
			}
			else if(!isset($id)) 
			{
				$lien_suivant = '<a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/article/page/2>suivant</a>';
				return $lien_suivant;
			}
		}

		public function pagination_lien_precedent($id)
		{
			if(isset($id) && $id > 2)
			{
				$page_precedent = $id - 1;
				$lien_precedent = '<a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/article/page/'.$page_precedent.'>precedent</a>';;
				return $lien_precedent;
			}
			else if(isset($id) && $id == 2)
			{
				$lien_precedent = '<a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/article>precedent</a>';
				return $lien_precedent;
			}
		}

		/////////
		public function pagination_users()
		{
			$pagination = 20;
			$sth = $this->bdd->prepare('SELECT * FROM users');
			$sth->execute();
			$result = $sth->fetchall(PDO::FETCH_ASSOC);
			$nb_total = count($result);
			$nb_pages = ceil($nb_total / $pagination);
			
			return $nb_pages;
		}

		public function pagination_lien_suivant_users($id)
		{
			if(isset($id) && $id < $this->pagination_users())
			{
				$page_suivante = $id + 1;
				$lien_suivant = '<a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/article/page/'.$page_suivante.'>suivant</a>';
				return $lien_suivant;
			}
			else if(!isset($id)) 
			{
				$lien_suivant = '<a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/article/page/2>suivant</a>';
				return $lien_suivant;
			}
		}

		public function pagination_lien_precedent_users($id)
		{
			if(isset($id) && $id > 2)
			{
				$page_precedent = $id - 1;
				$lien_precedent = '<a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/article/page/'.$page_precedent.'>precedent</a>';;
				return $lien_precedent;
			}
			else if(isset($id) && $id == 2)
			{
				$lien_precedent = '<a href='.WEBROOT.'blog/user/'.$_SESSION['user'].'/article>precedent</a>';
				return $lien_precedent;
			}
		}

		////////

		public function delete_article($id_article)
		{
			$sth = $this->bdd->prepare('DELETE FROM article WHERE id = :id');
			$sth->execute(array('id'=>$id_article));

			$stmp = $this->bdd->prepare('DELETE FROM commentaires WHERE id_article = :id_article');
			$stmp->execute(array('id_article'=>$id_article));
		}

		public function add_tags($tags)
		{
			$sth = $this->bdd->prepare('INSERT INTO tags(tags,user) VALUES(:tags,:user)');
			$sth->execute(array('tags'=>$tags['new_tags'],'user'=>$_SESSION['user']));
		}

		public function update_tags($tags,$id)
		{
			$sth = $this->bdd->prepare('UPDATE tags SET tags = :tags WHERE id = :id');
			$sth->execute(array('tags'=>$tags['tag'],'id'=>$id));
		}

		public function delete_tags($id)
		{
			$sth = $this->bdd->prepare('DELETE FROM tags WHERE id = :id');
			$sth->execute(array('id'=>$id));
		}

		public function delete_mail($id)
		{
			$sth = $this->bdd->prepare('DELETE FROM contact WHERE id = :id');
			$sth->execute(array('id'=>$id));
		}

		public function delete_commentaire($id)
		{
			$sth = $this->bdd->prepare('DELETE FROM commentaires WHERE id = :id');
			$sth->execute(array('id'=>$id));
		}
	}

?>