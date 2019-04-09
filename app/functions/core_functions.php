<?php
function getSettings($name){
  switch ($name) {
    case 'city_id':
        return 1;
      break;
      case 'user_id':
          return 1;
        break;
    default:
        return false;
      break;
  }
}

function variant_imp($a,$b){
  /*if(a && b) return true;
  if(!a) return true;*/
  if($a && !$b) return false;
  return true;
}


function view($data=array(), ...$templates){
  /*
  для посылки данных первый параметр фун. с перечислением переменных- compact('adverts'),
  остальные параметры - имена подключаемых файлов
  view(compact('adverts'),'home.php');
  */
  if(isset($_SESSION['user']))
    $user=$_SESSION['user'];
  else {
    $user=false;
  }
  if(is_array($data))extract($data);
  else include_once(TEMPLATES_DIR.$data);

  foreach ($templates as  $file) {
      include_once(TEMPLATES_DIR.$file);
  }

}

?>
