<?php
namespace App\Controllers;

use App\Models\MAuth;
use App\Models\DBConnect;
use App\Models\MParameters;
use App\Models\MLandmark;
use App\Models\MAdvert;
use App\Models\MCatalog;

class CAdvert extends CBase
{
    private $mParam, $auth, $mAdvert, $db;

    function __construct()
    {
        $this->mParam = new MParameters();
        $this->mLandmarks = new MLandmark();
        $this->mAdvert = new MAdvert();
        $this->mCatalog = new MCatalog();
    }

    public function main($action, $id=0)
    {

      switch ($action) {
        case 'advert':
        //показ одного объявления
          $advert= $this->mAdvert->getOne($id);
          $photos= $this->mAdvert->getPhotos($id);
          $param_values= $this->mParam->getForAdvert($id);
          $breadCrumbs = $this->mCatalog->breadCrumbs($advert['catalog_id']);
          if(isset($_SESSION['user']))$user = $_SESSION['user'];
          else $user=false;
                view(compact('user','advert', 'param_values','breadCrumbs','photos'),'head.php','advert.php','bottom.php');
          break;
        case 'save_advert':
        //сохранение данных из формы
            if(count($_POST)>0){
               if($advert_id=$this->save()) {
                 header("Location: /advert/".$advert_id); /* Перенаправление браузера */
                 echo ' сохранили '.$advert_id;
               }
               else{
                 $this->showBadRequest('ошибка данных');

               };
            }else{
              $this->showBadRequest('нет данных');

            };

            break;
        case 'archive':
            $this->mAdvert->archive($id);
            header("Location: /");
            break;
        case 'edit_advert':
        //показ формы
              if($id==0){
                $errors[]='Неверный Id';
                  view(compact('errors'),'head.php','error.php','bottom.php');
              }else{
                $advert= $this->mAdvert->getOne($id);
                $photos= $this->mAdvert->getPhotos($id);
                $param_values= $this->mParam->getForAdvert($id);

                $city_id = getSettings('city_id');
                $params = $this->mParam->getParametrsForCatalog($advert['catalog_id']);
                $landmarks = $this->mLandmarks->getLandmarks($city_id);
                $breadCrumbs = $this->mCatalog->breadCrumbs($advert['catalog_id']);
                $catalog_id=$id;
                view(compact('advert','photos','param_values','city_id','params','landmarks','breadCrumbs','catalog_id'),
                'head.php','add_advert.php','bottom.php');
              }
        case 'form_advert':
        //показ формы
              if($id==0){
                  $catalog = $this->mCatalog->getTree(1);
                  view(compact('catalog'),'head.php','select_catalog.php','bottom.php');
              }else{
                $advert= array('advert_name'=>false,'advert_id'=>false,'advert_address'=>false, 'advert_description'=>false, 'advert_condition_id'=>false);
                $photos= false;
                $param_values= false;

                $city_id = getSettings('city_id');
                $params = $this->mParam->getParametrsForCatalog($id);
                $landmarks = $this->mLandmarks->getLandmarks($city_id);
                $breadCrumbs = $this->mCatalog->breadCrumbs($id);
                $catalog_id=$id;
                view(compact('advert','photos','param_values','city_id','params','landmarks','breadCrumbs','catalog_id'),'head.php','add_advert.php','bottom.php');
              }
              break;
        default:
          echo ' запрос не распознан ';
          break;
      }


    }


    public function save(){

      if(!isset($_POST["catalog_id"])  ||   !isset($_POST["advert_name"]) ||   !isset($_POST["landmark_id"]) ||   !isset($_POST["advert_condition_id"])) {
        return false;
      }


      if(is_numeric($_POST["catalog_id"]) && (strlen($_POST["advert_name"])<=100)
      && is_numeric($_POST["landmark_id"]) && is_numeric($_POST["advert_condition_id"])) {


      $fields[':catalog_id']=$_POST["catalog_id"];
      $fields[':landmark_id']=$_POST["landmark_id"];
      $fields[':advert_name']=htmlspecialchars ($_POST["advert_name"]);

      if(isset($_POST["advert_description"]))
        $fields[':advert_description']=substr(htmlspecialchars ($_POST["advert_description"]) , 0 , 1000);
      else $fields[':advert_descriptions']='';
      if(isset($_POST["advert_address"]))
        $fields[':advert_address']=substr(htmlspecialchars ($_POST["advert_address"]) , 0 , 500);
      else $fields[':advert_address']='';
      $fields[':advert_condition_id'] = ($_POST["advert_condition_id"] <= 3) ? $_POST["advert_condition_id"]:1;
      $fields[':city_id'] = getSettings('city_id');
      $fields[':user_id'] = getSettings('user_id');
      if(is_numeric($_POST["advert_id"])){ $advert_id = $_POST["advert_id"];
        $this->mAdvert->update($advert_id, $fields);
        $this->mParam->del_values($advert_id);
        $imgName = $this->imgUpload($advert_id);
        $this->mAdvert->updateImgName($imgName, $advert_id);
      }
      else{
        $advert_id=$this->mAdvert->save($fields);
        $imgName = $this->imgUpload($advert_id);
        $this->mAdvert->saveImgName($imgName, $advert_id);
      }
      if($advert_id){
        $this->mParam->save_values($_POST['params_values'], $advert_id);
        return $advert_id;}
      else{ echo "ошибка сохранения"; return false;}

      }
      else{
        echo 'поля не верны';
        return false;
      }

    }

    public function imgUpload ($advert_id=0) {

      $extentions = array("image/png"=>'png',"image/jpeg"=>'jpeg',"image/gif"=>'gif');

      if(!count($_FILES)) {  }

      elseif($_FILES["photo"]["size"] > 10500000) {
          $_SESSION['errors'][] = "размер файла ".$_FILES["photo"]["name"]." превышает допусимый";
          return false;
      }

      elseif($_FILES["photo"]["error"] !== 0) {
          $_SESSION['errors'][] =  "произошли ошибки на сервере -".$_FILES["photo"]["name"];
          return false;
      }

      elseif( !isset($extentions[$_FILES["photo"]["type"]])  ) {
          $_SESSION['errors'][] =  "недопустимый тип файла ".$_FILES["photo"]["name"];
          return false;
      }

      else {
          $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/img/adverts/';

          $newName = $advert_id.'_'. substr(md5(time() . rand(0,99999)) , 0 , 10) . "." . $extentions[$_FILES["photo"]["type"]];

          $filedir = $uploaddir.$newName;

          move_uploaded_file($_FILES["photo"]["tmp_name"], $filedir);


          $_SESSION['message'][] = "Файл ".$_FILES["photo"]["name"]. " успешно загружен";

          return $newName;
      }

    }



}
