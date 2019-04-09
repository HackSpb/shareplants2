<?php
namespace App\Controllers;



class CInfo extends CBase
{
  function __construct()
  {

  }

  public function main($action, $id=0)
  {
      view('head.php', 'info/'.$action.'.php','bottom.php');

  }
}

?>
