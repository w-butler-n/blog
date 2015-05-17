<?php
	class administration extends Controller
	{
		public function index()
		{

		}

		public function view_site_admin()
		{
			unset($_SESSION['level']);
			header('Location: '.WEBROOT.'blog/index/1');
			$_SESSION['level'] = 'admin_view';
		}

		public function view_panel_site()
		{
			unset($_SESSION['level']);
			$_SESSION['level'] = 'admin';
			header('Location: '.WEBROOT.'blog/user');
		}

		public function delete_article($id)
		{
			$this->loadModel('admin');
			if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'blogger' || $_SESSION['level'] == 'admin_view')
			{
				$this->admin->delete_article($id);
			}
			if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'blogger')
			{
				header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/article');
			}
			else if($_SESSION['level'] == 'admin_view')
			{
				header('Location: '.WEBROOT.'blog/index/1');
			}
		}

		public function update_article($id)
		{
			$this->loadModel('admin');
			if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'blogger')
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
			    $recup_image = $this->admin->recup_image_by_id($id);
			    if(empty($_FILES['image']['name']))
			    {
			    	$_FILES['image']['name'] = $recup_image['image'];
			    }

				$this->admin->update_article($_POST,$_FILES['image']['name'],$id);
			}
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/article');
		}

		public function update_article_by_index($id)
		{
			$_SESSION['level'] = 'admin';
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/edit-article/'.$id.'');
		}

		public function delete_user($id)
		{
			$this->loadModel('admin');
			if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'blogger')
			{
				$this->admin->delete_user($id);
			}
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/infos-users');
		}

		public function update_user($id)
		{
			$this->loadModel('admin');
			if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'blogger')
			{
				$this->admin->update_user($_POST,$id);
			}
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/infos-users');
		}

		public function add_tags()
		{
			$this->loadModel('admin');
			if(isset($_POST['insert_tags']))
			{
				$this->admin->add_tags($_POST);
			}
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/tags');
		}

		public function update_tags($tags)
		{
			$this->loadModel('admin');
			if(isset($_POST['update_tags']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'blogger')
			{
				$this->admin->update_tags($_POST,$tags);
			}
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/tags');
		}

		public function delete_tags($tags)
		{
			$this->loadModel('admin');
			if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'blogger')
			{
				$this->admin->delete_tags($tags);
			}
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/tags');
		}

		public function delete_mail($mail)
		{
			$this->loadModel('admin');
			if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'blogger')
			{
				$this->admin->delete_mail($mail);
			}
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'/mail');
		}

		public function delete_commentaire($commentaire)
		{
			$this->loadModel('admin');
			$this->admin->delete_commentaire($commentaire);
			header('Location: '.WEBROOT.'blog/index/1');
		}
	}
?>