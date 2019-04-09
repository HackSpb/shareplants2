<?php

namespace App\Models;

use App\Models\DBConnect;
use PDO;

class MFeedback
{
    private $db;

    function __construct()
    {
        $DBobj = new DBConnect();
        $this->pdo = $DBobj->connect();
    }


    public function checkError($email,$name, $message){
    	$error=array();
  		
  		if(!isset($name)){
  			$error[]='Необходима имя';
  		}elseif(strlen($name)<2){
			$error[]='Короткое имя';
  		}
  		
  		if(!preg_match("|^([a-z0-9_-]+\.)*[a-z0-9_-]+@([a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6})$|i", $email)){ 
  			$error[]='Необходим емейл';
  		}
  		
  		if(!isset($message)){
  			$error[]='Необходимо сообщение';
  		}elseif(strlen($message)<=5){
			$error[]='Короткое сообщение';
  		}

  		if(count($error)>0){
  			return $error;
  		}else{
  			return false;
  		}

    }


	public function save($email,$name, $message){

	$sql = "
        INSERT INTO `feedback` (`feedback_id`, `feedback_name`, `feedback_email`, `feedback_message`) VALUES (NULL, :name, :email, :message);
      ";

      //$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
      $sth =  $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      try{
        $sth->execute(array('email'=> $email, ':name'=>$name,  ':message'=>$message));
      }
      catch (PDOException $e) {
        return false;
      }
      return true;
	}
}