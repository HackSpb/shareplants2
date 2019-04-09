<?php

namespace App\Models;

use App\Models\DBConnect;
use PDO;

/*ALTER TABLE landmarks ADD FOREIGN KEY (`city_id`) REFERENCES cities(`city_id`)*/

class MLandmark
{
    private $db;

    function __construct()
    {
        $DBobj = new DBConnect();
        $this->pdo = $DBobj->connect();
    }
    public function getLandmarks ($city_id) {
      $sql = "SELECT * FROM `landmarks` WHERE `city_id` =  $city_id ORDER BY landmark_name";
      $stmt = $this->pdo->query($sql);
      $landmarks = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $landmarks;
    }
}
