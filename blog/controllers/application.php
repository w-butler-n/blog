<?php
	class application extends Controller
	{
		
		public function index()
		{
			
		}

		public function ajout_article()
		{
			if($_SESSION['level'] == 'admin' || $_SESSION['blogger'])
			{
				if(isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
			    {
			        if ($_FILES['image']['size'] <= 3000000)
			        {
			            $infosfichier = pathinfo($_FILES['image']['name']);
			            $extension_upload = $infosfichier['extension'];
			            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
			            if (in_array($extension_upload, $extensions_autorisees))
			            {
			                move_uploaded_file($_FILES['image']['tmp_name'],'./test/' . basename($_FILES['image']['name']));
			            }
			        }
			    }

				if(isset($_POST['new_article']))
				{
					$this->loadModel('admin');
					$this->admin->ajout_article($_POST,$_FILES['image']['name']);
				}
			}

			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/article');
		}

		public function ajout_commentaires()
		{
			if(isset($_POST['add_commentaire']))
			{
				$this->loadModel('article');

				if(!empty($_POST['commentaire']))
				{
					$this->article->ajout_commentaires($_POST);
				}
			}

			header('Location: '.WEBROOT.'blog/article/'.$_SESSION['id_article'].'');
		}

		public function inscription()
		{
			if(isset($_POST['submit_new_user']))
			{
				$this->loadModel('user');
				if(!empty($_POST['identifiant']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['telephone']) && !empty($_POST['genre']))
				{
					$this->user->inscription($_POST);
				}
			}
			header('Location: '.WEBROOT.'blog/index/1');
		}

		public function add_contact()
		{
			if(isset($_POST['new_contact']))
			{
				$this->loadModel('contact');
				if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']))
				{
					$this->contact->add_contact($_POST);
				}
			}
			header('Location: '.WEBROOT.'blog/index/1');
		}
	}
?>