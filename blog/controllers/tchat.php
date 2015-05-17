<?php
	class tchat extends Controller
	{
		
		public function index()
		{
			$this->loadModel('tchat_online');
			
			if($_POST['method'] == "gomess")
			{
		        if(!empty($_POST['addmessage']))
		        {
		          	$this->tchat_online->envoie_message($_POST);   
		     	}
		    }

		    if($_POST['method'] == "go")
		    {
		        $this->tchat_online->chat_message();
		        header('Content-Type: application/json; charset=utf-8');
		        echo $recup_message;
		    }   
		}
	}
?>