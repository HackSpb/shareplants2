<?php

namespace App\Models;

use App\Models\DBConnect;
use App\Models\MCatalog;
use PDO;

class MParameters
{
    private $db;

    function __construct()
    {
        $DBobj = new DBConnect();
        $this->pdo = $DBobj->connect();

        $this->mCatalog = new MCatalog();
    }


    public function del_values($advert_id){

        $sql = 'DELETE FROM `parameters_values` WHERE advert_id='.$advert_id;
        $stmt = $this->pdo->query($sql);
    }
      public function save_values($params_values, $advert_id){

      $sql = 'SELECT * FROM `parameters`';
      $stmt = $this->pdo->query($sql);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $params[$row['param_id']] = $row;
      }

      $values_insert = array ();

      foreach ($params_values as $param_id => $value) {
        //вдруг здесь плохие данные
        if(!is_numeric($param_id)) continue;

        if ($params[$param_id]['param_type_id'] == 1 && is_numeric($value)) {
          $value = intval($value);
          if ($params[$param_id]['param_min_value'] < $value && $value < $params[$param_id]['param_max_value']) {
            $values_insert[] = "(NULL, '$param_id', '$value', '', '1', '$advert_id')";
          }
        }elseif ($params[$param_id]['param_type_id'] == 2 && is_string($value)) {

          if (strlen($value) > $params[$param_id]['param_min_value'] && strlen($value) < $params[$param_id]['param_max_value']) {
            $values_insert[] = "(NULL, '$param_id', '', '$value', '1', '$advert_id')";
          }
        }elseif (is_array($value)) {
          foreach ($value as $option_id) {
            if (is_numeric($option_id)) {
              $values_insert[] = "(NULL, '$param_id', '', '', '$option_id', '$advert_id')";
            }
          }
        }

      }
      if(count($values_insert)>0)
      {
        /* INSERT INTO `parameters_values` (`param_value_id`, `param_id`, `param_value_int`, `param_value_str`, `param_option_id`, `advert_id`)
         VALUES (NULL, '3', '17', '', '1', '11'), (NULL, '5', '', '', '2', '11');
        */

          $sql = 'INSERT INTO `parameters_values` (`param_value_id`, `param_id`, `param_value_int`, `param_value_str`, `param_option_id`, `advert_id`)
          VALUES '. implode(",", $values_insert);
          $sth =  $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          try{
            $sth->execute();
          }
          catch (PDOException $e) {
            return false;
          }
      }




      return true;


    }



    public function getParametrsForCatalog ($catalog_id, $catalog_parent = null) {



      /*   Запрашиваем т. catalogs       Узнаем через рекурсию все вышестоящие id каталогов (parents)*/
      if($catalog_parent)
        $sql = "SELECT * FROM `catalog` WHERE `catalog_id` <=  $catalog_parent ORDER BY catalog_id";
      else
        $sql = "SELECT * FROM `catalog` WHERE `catalog_id` <=  $catalog_id ORDER BY catalog_id";

      $stmt = $this->pdo->query($sql);
      $catalog = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $catalogs_list = $catalog_id;
      if($catalog_parent){
        $catalogs_list .= ',' . $catalog_parent;
        $catalogs_list .= ',' . $this->mCatalog->searchParents($catalog,$catalog_parent);
      } else {
        $catalogs_list .= ',' . $this->mCatalog->searchParents($catalog,$catalog_id);
      }

      $catalogs_list= trim($catalogs_list, ',');


      /*
      в качестве подзапроса -  По списку родителей ищем все параметры с пом. т. parametr_catalog  Получаем список id параметров
        SELECT `param_id` FROM `parameter_catalog` WHERE `catalog_id` IN (12,5,2,1)
      По списку параметров выбираем из таблицы параметров все параметры
        SELECT * FROM `parameters` WHERE `param_id` in (SELECT param_id FROM `parameter_catalog` WHERE `catalog_id` IN (12,5,2,1))
      выбираем все группы и сортируем по ним параметры

      SELECT * FROM `parameters`
      Left JOIN `parameters_types` USING (`param_type_id`)
      Left JOIN `parameters_groups` USING (`param_group_id`)
      WHERE `param_id` in (SELECT param_id FROM `parameter_catalog` WHERE `catalog_id` IN (12,2,1))
      Order By `param_group_id`, `param_id` */



    $sql = 'SELECT * FROM `parameters`
            Left JOIN `parameters_types` USING (`param_type_id`)
            Left JOIN `parameters_groups` USING (`param_group_id`)
            WHERE `param_id` in (SELECT `param_id` FROM `parameter_catalog` WHERE `catalog_id` IN ('. $catalogs_list .'))
            Order By `param_group_id`, `param_id`';

            $stmt = $this->pdo->query($sql);
            $params = $stmt->fetchAll(PDO::FETCH_ASSOC);


      /*
      И добавляем к ним опции из т. parametrs_options
      В результате должен получиться массив с параметрами и опциями

      SELECT * FROM `parameters_options` WHERE `param_id` in (SELECT `param_id` FROM `parameter_catalog` WHERE `catalog_id` IN (15,4,1))
      */

    $sql = 'SELECT * FROM `parameters_options` WHERE `param_id` in (SELECT `param_id` FROM `parameter_catalog` WHERE `catalog_id` IN ('. $catalogs_list .'))';
    $stmt = $this->pdo->query($sql);
    $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $count = count($options);
    for ($i = 0; $i < $count; $i++) {
        $options_struct[$options[$i]['param_id']][] = $options[$i];
      }

    $count = count($params);
    $group_number=0;
    $params_struct=array();
    for ($i = 0; $i < $count; $i++) {
      //$params_new[$params[$i]['param_group_id']][] = $params[$i];
      if(isset($options_struct[$params[$i]['param_id']])) $params[$i]["options"] =  $options_struct[$params[$i]['param_id']];
      $params_struct[$group_number][] = $params[$i];
      if(isset($params[$i+1]) && $params[$i]['param_group_id']!=$params[$i+1]['param_group_id']) $group_number++;
      //добавить опции
    }
    return $params_struct;
    }


public function getForAdvert ($advert_id) {
    $sql = "SELECT `parameters_values`.*,`p`.*, `p_g`.`param_group_name`, `p_o`.`param_option_name`, `p_o`.`param_option_altername`
      FROM `parameters_values`
      LEFT JOIN `parameters` as `p` USING (`param_id`)
      LEFT JOIN `parameters_groups` as `p_g` USING (`param_group_id`)
      LEFT JOIN `parameters_options` as `p_o` USING (`param_option_id`)
      WHERE `advert_id` = $advert_id
      ORDER BY `parameters_values`.`param_id`, `p_o`.`param_option_name`";
              $stmt = $this->pdo->query($sql);
              /*$group_number=-1;
              $old_group_id=0;
              $old_param_id=0;*/
    $param_values = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              /* if($old_group_id!=$row['param_group_id']){$group_number++;}
                $old_group_id=$row['param_group_id'];
                $old_param_id=$row['param_id'];*/
                if(isset($param_values[$row['param_group_id']][$row['param_id']]['options'])){
                  $row['options']=$param_values[$row['param_group_id']][$row['param_id']]['options'];
                }
                $row['options'][$row['param_option_id']]=array('param_option_name' =>  $row['param_option_name'],
             'param_option_altername'=> $row['param_option_altername']);
                $param_values[$row['param_group_id']][$row['param_id']] = $row;
              }
              return $param_values;
}


}
