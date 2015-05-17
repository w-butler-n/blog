<?php
	class users extends Controller
	{
		
		public function index()
		{
			
		}

		public function connexion()
		{
			$this->loadModel('user');
			if(isset($_POST['verif_user']))
			{
				if(!empty($_POST['identifiant']) && !empty($_POST['password']))
				{
					$this->user->connexion($_POST);
				}
			}
			if(isset($_SESSION['level']))
            {
                header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'');
            }
            else
            {
            	header('Location: '.WEBROOT.'blog/index/1/error');
            }
			
		}

		public function update_infos($id)
		{
			$this->loadModel('user');
			if(isset($_SESSION['level']))
			{
				$this->user->update_infos($_POST,$id);
			}
			header('Location: '.WEBROOT.'blog/user/'.$_SESSION['user'].'');
		}

		public function logout()
		{
			unset($_SESSION['user']);
			unset($_SESSION['level']);
			header('Location: '.WEBROOT.'blog/index/1');
		}
	}
?>