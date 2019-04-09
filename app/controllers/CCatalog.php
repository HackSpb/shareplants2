<?php
namespace App\Controllers;

use App\Models\MAuth;
use App\Models\DBConnect;
use App\Models\MParameters;
use App\Models\MLandmark;
use App\Models\MAdvert;
use App\Models\MCatalog;


class CCatalog extends CBase
{
  private $mParam, $auth, $mAdvert, $db;

  function __construct()
  {
      $this->mParam = new MParameters();
      $this->mLandmarks = new MLandmark();
      $this->mAdvert = new MAdvert();
      $this->mCatalog = new MCatalog();
  }

  public function main($action, $catalog_id=0)
  {
    $children_ids_str =  $this->mCatalog->getChildrenIds($catalog_id);

    if(isset($_GET['params_values'])) $adverts = $this->mAdvert->getFromCatalogFilter($children_ids_str, $_GET['params_values']);
    else $adverts = $this->mAdvert->getFromCatalog($children_ids_str);

    view('head.php');
    if($catalog_id==0) view(compact('adverts'),'top.php','home.php');
    else {
      $catalog_tree = $this->mCatalog->getTree($catalog_id);
      $breadCrumbs = $this->mCatalog->breadCrumbs($catalog_id);
      $params = $this->mParam->getParametrsForCatalog($catalog_id);
      view(compact('adverts','catalog_tree','breadCrumbs','params'),'filter.php', 'catalog.php');
    }
    view('bottom.php');

  }



}
