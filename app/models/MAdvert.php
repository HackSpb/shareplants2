<?php
namespace App\Models;

use App\Models\DBConnect;
use PDO;

class MAdvert
{
    private $db;

    function __construct()
    {
        $DBobj = new DBConnect();
        $this->pdo = $DBobj->connect();
    }

    function save($fields){

      /*INSERT INTO `adverts` (`advert_id`, `city_id`, `catalog_id`, `user_id`, `landmark_id`, `advert_name`,
       `advert_description`, `advert_address`, `advert_condition_id`, `advert_date`, `advert_view_count`, `advert_archive`)
       VALUES (NULL, '1', '10', '1', '1', 'кактус', 'супер кактус', 'чкаловский проспект 15', '2', CURRENT_TIMESTAMP, '0', '0');*/

            $sql = 'INSERT INTO `adverts` (`advert_id`, `city_id`, `catalog_id`, `user_id`, `landmark_id`, `advert_name`,
               `advert_description`, `advert_address`, `advert_condition_id`, `advert_date`, `advert_view_count`, `advert_archive`)
            VALUES (NULL, :city_id, :catalog_id, :user_id, :landmark_id, :advert_name,
               :advert_description, :advert_address, :advert_condition_id, CURRENT_TIMESTAMP, 0, 0);';
            $sth =  $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            try{$sth->execute($fields);
            }
            catch (PDOException $e) {
              return false;
            }

            return $this->pdo->lastInsertId();

    }


    function update($advert_id, $fields){
      $sql = "UPDATE `adverts` SET
      `advert_name` = :advert_name,
      `advert_description` = :advert_description,
      `landmark_id` = :landmark_id,
      `advert_condition_id` = :advert_condition_id,
      `advert_address` = :advert_address

      WHERE `adverts`.`advert_id` = $advert_id";

      $sth =  $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

      $sth->bindParam(':advert_name', $fields[':advert_name']);
      $sth->bindParam(':advert_description', $fields[':advert_description']);
      $sth->bindParam(':landmark_id', $fields[':landmark_id']);
      $sth->bindParam(':advert_condition_id', $fields[':advert_condition_id']);
      $sth->bindParam(':advert_address', $fields[':advert_address']);
      try{$sth->execute();
      }
      catch (PDOException $e) {
        return false;
      }


    }

    public function saveImgName ($imgName, $advert_id) {

        $sql = "INSERT INTO `photos`(`photo_id`, `advert_id`, `photo_file`, `photo_description`)
        VALUES (NULL, $advert_id,'$imgName','');";
        $sth =  $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        try{$sth->execute();
        }
        catch (PDOException $e) {
          return false;
        }
        return true;
    }


    public function updateImgName ($imgName, $advert_id) {

        $sql = "UPDATE `photos` SET  `photo_file` = '$imgName'
        WHERE `advert_id` = $advert_id";

        try{$this->pdo->query($sql);
        }
        catch (PDOException $e) {
          return false;
        }
        return true;
    }


    public function archive ($advert_id) {

        $sql = "UPDATE `adverts` SET `advert_archive` = '1' WHERE `adverts`.`advert_id` =  $advert_id";

        try{$this->pdo->query($sql);
        }
        catch (PDOException $e) {
          return false;
        }
        return true;
    }


  public function getFromCatalogFilter ($children_ids_str=0, $params_values) {

/*
SELECT * FROM `adverts`
WHERE advert_id in ( select advert_id from parameters_values where parameters_options=11 and )


SELECT a.*, ac.* FROM `adverts` as a
LEFT JOIN adverts_conditions as ac USING(`advert_condition_id`)
INNER JOIN parameters_values as pv ON pv.param_option_id=11 and pv.advert_id = a.advert_id
INNER JOIN parameters_values as pv2 ON pv2.param_option_id=16 and pv2.advert_id = a.advert_id

*/

    /*наши доверенные параметры*/
    $sql = 'SELECT * FROM `parameters`';
    $stmt = $this->pdo->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $params[$row['param_id']] = $row;
    }


    $inner_join  = array ();
    foreach ($params_values as $param_id => $value) {
      //вдруг здесь плохие данные
      if(!is_numeric($param_id)) continue;

      if ($params[$param_id]['param_type_id'] == 1 && is_numeric($value['min']) && is_numeric($value['max']) ) {
        $value['min'] = intval($value['min']);
        $value['max'] = intval($value['max']); echo 1;
        if ($params[$param_id]['param_min_value'] <= $value['min'] && $value['max'] <= $params[$param_id]['param_max_value']) {
          $inner_join[] = "INNER JOIN parameters_values as pv$param_id ON pv$param_id.param_value_int>$value[min] and pv$param_id.param_value_int<$value[max] and pv$param_id.advert_id = a.advert_id";
        }
      }elseif ($params[$param_id]['param_type_id'] == 2 && is_string($value)) {

        if (strlen($value) >= $params[$param_id]['param_min_value'] && strlen($value) <= $params[$param_id]['param_max_value']) {
          $inner_join[] = "INNER JOIN parameters_values as pv$param_id ON pv$param_id.param_value_str_id='$value' and pv$param_id.advert_id = a.advert_id";
        }
      }elseif (is_array($value)) {
        foreach ($value as $option_id) {
          if (is_numeric($option_id)) {
            $inner_join[] = "INNER JOIN parameters_values as pv$option_id ON pv$option_id.param_option_id='$option_id' and pv$option_id.advert_id = a.advert_id";
          }
        }
      }

    }

    $inner_join_str = implode(" ", $inner_join);
    $adverts=array();
    // $sql = "SELECT * FROM `adverts` WHERE `catalog_id` =  $city_id ";
    if($children_ids_str){
      $sql = "SELECT  a.*, ac.*, ph.* FROM `adverts` as a
      LEFT JOIN adverts_conditions as ac USING(`advert_condition_id`)
      LEFT JOIN photos as ph USING(`advert_id`)
      $inner_join_str
      WHERE catalog_id in ($children_ids_str) and city_id = ".getSettings('city_id')."
      ORDER BY a.advert_id";
    }else{
      $sql = "SELECT  a.*, ac.* FROM `adverts` as a
      $inner_join_str
      LEFT JOIN adverts_conditions as ac USING(`advert_condition_id`)
      ORDER BY a.advert_id";
    }

    $stmt = $this->pdo->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //if(ISSET($params_values[$row['advert_id']]))$row['params'] = $params_values[$row['advert_id']];
        $adverts[]=$row;
      }


    return $adverts;


  }

    /*объявления конкретного пользователя*/
    public function getForUser ($user_id) {

      $sql = 'SELECT pv.*, p.*,po.* FROM `parameters_values` as pv
      LEFT JOIN parameters as p USING(`param_id`)
      LEFT JOIN parameters_options as po USING(`param_option_id`)
      LEFT JOIN `adverts` as a  USING(`advert_id`)
      WHERE a.user_id='.$user_id;
      $stmt = $this->pdo->query($sql);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $params_values[$row['advert_id']][] = $row;
      }

      $adverts=array();

      $sql = "SELECT DISTINCT a.*,ac.*, ph.photo_file
        FROM `adverts` as a
        LEFT JOIN adverts_conditions as ac USING(`advert_condition_id`)
        LEFT JOIN photos as ph USING(`advert_id`)
      WHERE a.user_id=$user_id
      ORDER BY a.advert_id";

      $stmt = $this->pdo->query($sql);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          if(ISSET($params_values[$row['advert_id']]))$row['params'] = $params_values[$row['advert_id']];
          $adverts[]=$row;
        }


      return $adverts;

    }

    /* объявления для конкретного каталога */
    public function getFromCatalog ($children_ids_str=0) {

      $sql = 'SELECT * FROM `parameters_values`
      LEFT JOIN parameters USING(`param_id`)
      LEFT JOIN parameters_options  USING(`param_option_id`)';
      $stmt = $this->pdo->query($sql);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $params_values[$row['advert_id']][] = $row;
      }

      $adverts=array();

      if($children_ids_str){
        $sql = "SELECT DISTINCT a.*,ac.*, ph.photo_file
          FROM `adverts` as a
          LEFT JOIN adverts_conditions as ac USING(`advert_condition_id`)
          LEFT JOIN photos as ph USING(`advert_id`)
          WHERE a.advert_archive=0 and catalog_id  in ($children_ids_str) and city_id = ".getSettings('city_id')."
        ORDER BY a.advert_id";
      }else{
        $sql = "SELECT DISTINCT a.*,ac.*, ph.photo_file
        FROM `adverts` as a
        LEFT JOIN adverts_conditions as ac USING(`advert_condition_id`)
        LEFT JOIN photos as ph USING(`advert_id`)
        WHERE a.advert_archive=0
        ORDER BY a.advert_id";
      }

      $stmt = $this->pdo->query($sql);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          if(ISSET($params_values[$row['advert_id']]))$row['params'] = $params_values[$row['advert_id']];
          $adverts[]=$row;
        }


      return $adverts;
    }

    public function getOne ($advert_id) {
      $sql = "SELECT *, 1 as `user_password`  FROM `adverts`
LEFT JOIN `cities` USING (`city_id`)
LEFT JOIN `landmarks` USING (`landmark_id`)
LEFT JOIN `adverts_conditions` USING (`advert_condition_id`)
LEFT JOIN `users` USING (`user_id`)
WHERE `advert_id`= $advert_id";
      $stmt = $this->pdo->query($sql);
      $adverts = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $adverts[0];
    }

    public function getPhotos ($advert_id) {
      $sql = "SELECT * FROM `photos`
      WHERE `advert_id`= $advert_id";
      $stmt = $this->pdo->query($sql);
      $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $photos;
    }


}
