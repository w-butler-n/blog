<?php
	class article extends Controller
	{

		public function recup_article($page)
		{
			
			if(!isset($page))
			{
				$indice = 1;
				$pagination = 6;
				$limite = ($indice - 1) * $pagination;
			}
			
			if(isset($page) && is_numeric($page))
			{
				$indice = $page;
				$pagination = 6;
				$limite = ($indice - 1) * $pagination;
			}

			$sth = $this->bdd->prepare('SELECT * FROM article LIMIT '.$limite.','.$pagination.'');
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		}

		public function select_tags()
		{
			$sth = $this->bdd->prepare('SELECT * FROM tags');
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function select_tags_by_id($id)
		{
			$sth = $this->bdd->prepare('SELECT * FROM tags WHERE id = :id');
			$sth->execute(array('id'=>$id));
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function recup_article_by_tags($tags = '',$page = 0)
		{
			if(!isset($page))
			{
				$indice = 1;
				$pagination = 6;
				$limite = ($indice - 1) * $pagination;
			}
			
			if(isset($page) && is_numeric($page))
			{
				$indice = $page;
				$pagination = 6;
				$limite = ($indice - 1) * $pagination;
			}

			$sth = $this->bdd->prepare('SELECT * FROM article WHERE tags = :genre LIMIT '.$limite.','.$pagination.'');
			$sth->execute(array('genre'=>$tags));
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		}

		public function pagination()
		{
			$pagination = 6;
			$sth = $this->bdd->prepare('SELECT titre FROM article');
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
				$lien_suivant = '<a href='.WEBROOT.'blog/index/'.$page_suivante.'>suivant</a>';
				return $lien_suivant;
			}
			else if(!isset($id)) 
			{
				$lien_suivant = '<a href='.WEBROOT.'blog/index/2>suivant</a>';
				return $lien_suivant;
			}
		}

		public function pagination_lien_precedent($id)
		{
			if(isset($id) && $id > 1)
			{
				$page_precedent = $id - 1;
				$lien_precedent = '<a href='.WEBROOT.'blog/index/'.$page_precedent.'>precedent</a>';
				return $lien_precedent;
			}
		}

		public function recup_article_by_id($id)
		{
			$sth = $this->bdd->prepare('SELECT * FROM article WHERE id = :id');
			$sth->execute(array('id'=>$id));
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function ajout_commentaires($commentaires)
		{
			$change_b = preg_match('#\[b\](.+)\[/b\]#',$commentaires['commentaire']);
			$change_i = preg_match('#\[i\](.+)\[/i\]#',$commentaires['commentaire']);
			$change_u = preg_match('#\[u\](.+)\[/u\]#',$commentaires['commentaire']);
			$change_a = preg_match('#\[a\](.+)\[/a\]#',$commentaire['commentaire']);
			$change_img = preg_match('#\[img\](.+)\[/img\]#',$commentaires['commentaire']);

			$commentaire['commentaire'] = preg_replace('#\[b\](.+)\[/b\]#', '<b>'.$commentaires['commentaire'].'</b>', $change_b);
			$commentaire['commentaire'] = preg_replace('#\[i\](.+)\[/i\]#', '<i>'.$commentaires['commentaire'].'</i>', $change_i);
			$commentaire['commentaire'] = preg_replace('#\[u\](.+)\[/u\]#', '<u>'.$commentaire['commentaire'].'</u>', $change_u);
			$commentaire['commentaire'] = preg_replace('#\[a\](.+)\[/a\]#', '<a href='.$commentaires['commentaire'].'>'.$commentaire['commentaire'].'</a>', $change_a);
			$commentaire['commentaire'] = preg_replace('#\[img\](.+)\[/img\]#', '<img src='.$commentaires['commentaire'].'>', $change_img);

			if(isset($_SESSION['user']))
			{
				$sth = $this->bdd->prepare('INSERT INTO commentaires(id_article,commentaire,pseudo,ip,date_ajout) VALUES(:id_article,:commentaire,:pseudo,:ip,NOW())');
				$sth->execute(array('id_article'=>$_SESSION['id_article'],'commentaire'=>$commentaires['commentaire'],'pseudo'=>$_SESSION['user'],'ip'=>$_SERVER['REMOTE_ADDR']));
			}
			else
			{
				$sth = $this->bdd->prepare('INSERT INTO commentaires(id_article,commentaire,pseudo,ip,date_ajout) VALUES(:id_article,:commentaire,"Anonyme",:ip,NOW())');
				$sth->execute(array('id_article'=>$_SESSION['id_article'],'commentaire'=>$commentaires['commentaire'],'ip'=>$_SERVER['REMOTE_ADDR']));
			}
		}

		public function affiche_commentaire($id)
		{
			$sth = $this->bdd->prepare('SELECT id,id_article,commentaire,pseudo,date_ajout FROM commentaires WHERE id_article = :id_article');
			$sth->execute(array('id_article'=>$id));
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
	}

?>