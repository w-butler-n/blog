<?php
	class blog extends Controller
	{
		
		public function index($id = 0,$erreur = '')
		{
			$this->loadModel('article');
			$_SESSION['view_admin'] = '';
			$d['tags'] = $this->article->select_tags();
			if(isset($id))
			{
				$d['articles'] = $this->article->recup_article($id);
				$d['pagination_suivant'] = $this->article->pagination_lien_suivant($id);
				$d['pagination_precedent'] = $this->article->pagination_lien_precedent($id);
			}
			if(!empty($erreur))
			{
				$d['erreur'] = 'mauvais compte';
			}
			$this->set($d);
			$this->render('index');
		}

		public function article($id = 0)
		{
			$this->loadModel('article');
			$d['tags'] = $this->article->select_tags();
			if(isset($id))
			{
				$d['article'] = $this->article->recup_article_by_id($id);
				$d['commentaire'] = $this->article->affiche_commentaire($id);
				$_SESSION['id_article'] = $id;
			}
			$this->set($d);
			$this->render('article');
			
		}

		public function tags($tags = '',$id = 0)
		{
			$this->loadModel('article');
			$d['tags'] = $this->article->select_tags();
			if(isset($id) && isset($tags))
			{
				$d['articles_tags'] = $this->article->recup_article_by_tags($tags,$id);
			}
			$d['pagination'] = $this->article->pagination_lien_suivant($id);
			$this->set($d);
			$this->render('tags');
		}

		public function user($user = '',$flag1 = '',$flag2 = '',$id = 1)
		{
			if($_SESSION['level'] == 'admin')
			{
				$this->loadModel('admin');
				$this->loadModel('article');
				$this->loadModel('contact');
				if($flag1 == 'article')
				{
					$d['article'] = $this->admin->recup_article($id);
					$d['pagination_suivant'] = $this->admin->pagination_lien_suivant($id);
					$d['pagination_precedent'] = $this->admin->pagination_lien_precedent($id);
					$d['flag_article'] = 1;
				}
				else if($flag1 == 'infos-users')
				{
					$d['users'] = $this->admin->recuperation_user($id);
					$d['pagination_suivant_users'] = $this->admin->pagination_lien_suivant_users($id);
					$d['pagination_precedent_users'] = $this->admin->pagination_lien_precedent_users($id);
				}
				else if($flag1 == 'edit-user' && !empty($flag2))
				{
					$d['edit_user_by_name'] = $this->admin->recup_user_by_name($flag2);
				}
				else if($flag1 == 'edit-article' && !empty($flag2))
				{
					$d['edit_article_by_id'] = $this->admin->recup_article_by_id($flag2);
				}
				else if($flag1 == 'tags')
				{
					$d['tags'] = $this->article->select_tags();
				}
				else if($flag1 == 'edit-tags')
				{
					$d['tags_edit'] = $this->article->select_tags_by_id($flag2);
				}
				else if($flag1 == 'mail'  && empty($flag2))
				{
					$d['mail'] = $this->contact->select_mail();
				}
				else if($flag1 == 'mail' && !empty($flag2))
				{
					$d['mail_by_id'] = $this->contact->recup_mail_by_id($flag2);
				}

				if(isset($d))
				{
					$this->set($d);
				}
				$this->render('dasboard');
			}
			else if($_SESSION['level'] == 'blogger')
			{

			}
			else
			{
				$this->loadModel('user');
				$d['infos_user'] = $this->user->infos_user($user);
				$this->set($d);
				$this->render('administration');
			}
		}

		public function tchat()
		{
			$this->loadModel('tchatonline');
			if($_POST['method'] == "gomess")
			{
		        if(!empty($_POST['addmessage']))
		        {
		          	$this->tchatonline->envoie_message($_POST);   
		     	}
		    }

		    $this->render('tchat');
		}

		public function passwordReset()
		{
			$this->loadModel('user');
			if(!empty($_POST['oublie_password']))
			{
				$d['adresse'] = $this->user->oublie_password($_POST);
				$this->set($d);
			}
			$this->render('passwordReset');
		}

		public function register()
		{
			$this->render('inscription');
		}

		public function edit_user()
		{
			$this->render('edit-user');
		}
	}
?>