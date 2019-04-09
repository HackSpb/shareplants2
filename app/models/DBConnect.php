<?php


namespace App\Models;

use PDO;

class DBConnect
{
    public $pdo;




    function connect($bdhost = HOST , $bduser = USER, $bdpass =PASS, $bdbase =DB) {
      $dsn = "mysql:host=$bdhost;dbname=$bdbase;charset=utf8";
      $opt = array(
       PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
       PDO::ATTR_EMULATE_PREPARES   => false,
   );
      $this->pdo = new PDO($dsn, $bduser, $bdpass, $opt);

		return $this->pdo;
	}

}




?>
