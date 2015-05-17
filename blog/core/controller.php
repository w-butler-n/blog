<?php
	class Controller
	{
		protected $bdd;
		protected $vars = array();
		protected $layout = 'default';
		protected $dasboard = 'dasboard';

		public function __construct()
		{
			try
			{
				$this->bdd = new PDO('mysql:host=localhost;dbname=my_web','root','');
			}
			catch(PDOExeption $e)
			{
				echo $e->getMessage();
			}
		}

		public function set($d)
		{
			if(isset($d))
			{
				$this->vars = array_merge($this->vars,$d);
			}
		}

		public function render($filename)
		{
			extract($this->vars);
			ob_start();
			require(ROOT.'views/'.get_class($this).'/'.$filename.'.php');
			$content_for_layout = ob_get_clean();
			
			if($this->layout == false)
			{
				echo $content_for_layout;
			}
			else
			{
				require(ROOT.'views/layout/'.$this->layout.'.php');
			}
		}

		public function loadModel($name)
		{
			require(ROOT.'model/'.strtolower($name).'.php');
			$this->$name = new $name();
		}
	}
?>