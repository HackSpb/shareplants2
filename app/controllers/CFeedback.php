<?php
namespace App\Controllers;

use App\Models\MFeedback;

class CFeedback extends CBase
{

 function __construct()
  {
      $this->mFeedback = new MFeedback();
  }

  public function main($action, $id=0)
  {
  	$name="";
  	$email="";
  	if(isset($_SESSION['user']['user_firstname']))$name=$_SESSION['user']['user_firstname'];
  	if(isset($_SESSION['user']['user_email']))$email=$_SESSION['user']['user_email'];	

  	if(isset($_POST['save'])){
  		if($error = $this->mFeedback->checkError($_POST['email'], $_POST['name'], $_POST['message'])){
  			view(compact('error','email','name'), 'head.php','top_mini.php', 'feedback.php','bottom.php');
  		}else{
  			if($this->mFeedback->save($_POST['email'], $_POST['name'], $_POST['message'])){
  				header("Location: /info/succes/");
  			}

  		}
  	}

  	view(compact('email','name'),'head.php','top_mini.php', 'feedback.php','bottom.php');
  }



}



?>