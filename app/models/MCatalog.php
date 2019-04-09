<?php

namespace App\Models;

use App\Models\DBConnect;
use PDO;

class MCatalog
{
    private $db;

    function __construct()
    {
        $DBobj = new DBConnect();
        $this->pdo = $DBobj->connect();
    }

    /* рекурсивная функция поиска родителя по текущему id.
      у любого из предков не может быть id больше чем у текущего
      удаление элементов на случай неотсортированного массива
      */
    public function searchParents (&$catalog, $current_id) {
      foreach ($catalog as $key => $value) {

        if ($value["catalog_id"] == $current_id) {
          $list=$value["catalog_parent"];
          /* 1 - корень дерева, дальше искать не нужно*/
          if($value["catalog_parent"]==1) return $list;

          $list .=',' . $this->searchParents($catalog,$value["catalog_parent"]);
          return $list;
        }
        /*else if ($value["catalog_id"] > $current_id) {
          unset($catalog[$key]);
          continue;
        }*/
      }
      return false;
    }

    public function searchParentsArr (&$catalog, $current_id) {
      foreach ($catalog as $key => $value) {
        if ($value["catalog_id"] == $current_id) {
          $list=array();
          /* 1 - корень дерева, дальше искать не нужно*/
          if($value["catalog_parent"]!=1)
            {
              $list=$this->searchParentsArr($catalog,$value["catalog_parent"]);
            }
          $list[]=$value;
          return $list;
        }
      }
      return false;
    }

    public function searchChildren(&$catalog, $current_id){
      /*ф. возвращает многоуровневый массив с потомками*/
      $list=array();
      foreach ($catalog as $key => $value) {
        if ($value["catalog_parent"] == $current_id) {
          if($c=$this->searchChildren($catalog,$value["catalog_id"]))
            $value['children'] = $c;
          $list[]=$value;
        }
      }
      if(count($list)) return $list;
      else return false;
    }

    public function searchChildrenIds(&$catalog, $current_id){
      /* рекурсивная ф. возвращает строку с ИД потомками*/
      $list=false;
      foreach ($catalog as $key => $value) {
        if ($value["catalog_parent"] == $current_id) {
            $list.=','.$value["catalog_id"];
          if($c=$this->searchChildrenIds($catalog,$value["catalog_id"]))
            $list .= ','. $c;
        }
      }
      return trim($list, ',');
    }

    public function searchFlatChildren(&$catalog, &$flat_tree_catalog, $current_id, $prefix=''){
      /*ф. плоский массив с именами*/
      foreach ($catalog as $key => $value) {
        if ($value["catalog_parent"] == $current_id) {
          $value['catalog_prefix_name']=$prefix.$value['catalog_name'];
          $flat_tree_catalog[] = $value;
          $this->searchFlatChildren($catalog,$flat_tree_catalog, $value["catalog_id"],$prefix.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
        }
      }
       return false;
    }


    public function getTree($catalog_id){
      $sql = "SELECT * FROM `catalog`";
      $stmt = $this->pdo->query($sql);
      $catalog = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $flat_tree_catalog=array();
      $this->searchFlatChildren($catalog,$flat_tree_catalog, $catalog_id);
      return $flat_tree_catalog;


    }


    public function breadCrumbs($catalog_id) {
      $sql = "SELECT * FROM `catalog` WHERE `catalog_id` <=  $catalog_id ORDER BY catalog_id";

      $stmt = $this->pdo->query($sql);
      $catalog = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $breadCrumbs= $this->searchParentsArr($catalog,$catalog_id);
      return $breadCrumbs;
    }

    public function getChildrenIds($catalog_id) {
      $sql = "SELECT * FROM `catalog` WHERE `catalog_id` >  $catalog_id ORDER BY catalog_id";

      $stmt = $this->pdo->query($sql);
      $catalog = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $children_ids_str = $catalog_id.',';
      $children_ids_str .= $this->searchChildrenIds($catalog,$catalog_id);
      return trim($children_ids_str, ',');
    }

}
