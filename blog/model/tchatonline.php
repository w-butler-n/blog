<?php
	class tchatonline extends Controller
	{

		public function envoie_message($message)
		{
			$sth = $this->bdd->prepare("INSERT INTO chat(user,message,date_message,ip) VALUES(:user,:message,NOW(),:ip)");
            $sth->execute(array('user'=>$_SESSION['user'],'message'=>$message['addmessage'],'ip'=>$_SERVER["REMOTE_ADDR"]));
		}

		public function chat_message()
        {
            $sth = $this->bdd->prepare("SELECT * FROM chat ORDER BY id desc LIMIT 10 ");
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            
           	foreach($result as $key){
                $messages[] = array
                (
                    "message"=>$key['message'],
                    "user"=>$_SESSION['user']
                );
                
            }
            return json_encode($messages); 
        }
	}

?>