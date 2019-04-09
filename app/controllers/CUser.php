<?php
namespace App\Controllers;

use App\Models\MUser;
use App\Models\MAdvert;

class CUser extends CBase
{
  function __construct()
  {
      $this->mUser = new MUser();
  }

  public function main($action, $id=0)
  {
    switch ($action) {
      case 'register':
        $this->register();
        break;
      case 'auth':
        $this->auth();
          break;
      case 'logout':
        $this->logout();
        break;
      case 'cabinet':
              $this->cabinet();
                  break;
      case 'edit':
        $this->edit();
            break;
      case 'save':
        $this->save();
            break;
      default:
        echo ' запрос не распознан ';
        break;
    }
    view('bottom.php');
  }


  public function cabinet() {


      if(isset($_SESSION['user']['user_id'])){

        $user=$_SESSION['user'];
        $this->mAdvert = new MAdvert();
        $adverts = $this->mAdvert->getForUser ($_SESSION['user']['user_id']);

        view(compact('adverts','user'), 'head.php','cabinet.php');

      }else{
        $this->showUnauthorized();
        view('head.php');
        echo '<h3>Ошибка доступа</h3>
        <div class="amado-btn-group mt-30 mb-100">
            <a href="/register/" class="btn amado-btn mb-20 my_reg-btn">Регистрация</a>
            <a href="/auth/" class="btn amado-btn">Авторизация</a>
        </div>

        ';
      }

  }

  public function register() {
    view('head.php');
        $user_firstname='';
        $user_email='';
        $user_phone='';
            if (isset($_POST['user_firstname'])) {
                $user_firstname = htmlspecialchars($_POST['user_firstname']);
                $user_password = htmlspecialchars($_POST['user_password']);
                $user_email = htmlspecialchars($_POST['user_email']);
                $errors = [];
                $user_phone = htmlspecialchars($_POST['user_phone']);
                $city_id = htmlspecialchars($_POST['city_id']);
                $user_password_repeat = $_POST['user_password_repeat'];
                if ($user_password !== $user_password_repeat) {
                    $errors[] = "Пароли должны совпадать";
                }
                if ($error = $this->mUser->checkNameError($user_firstname)) {
                    $errors[] = $error;
                }
                if ($error = $this->mUser->checkPasswordError($user_password)) {
                    $errors[] = $error;
                }
                if ($error = $this->mUser->checkEmailError($user_email)) {
                    $errors[] = $error;
                }
                if ($error = $this->mUser->checkPhoneError($user_phone)) {
                    $errors[] = $error;
                }
                if ($error = $this->mUser->checkCityError($city_id)) {
                    $errors[] = $error;
                }
        				if (empty($errors)) {
        					$this->mUser->register($user_firstname, $user_phone, $city_id, $user_password, $user_email);
        				}
                else {
                  view(compact('errors', 'user_firstname', 'user_email', 'user_phone'),'register.php');
        				}
            }
            view(compact('user_firstname', 'user_email', 'user_phone'),'register.php');
            return true;
        }

		public function auth() {
      $login = '';
			if (isset($_POST['login'])) {

				$login = htmlspecialchars($_POST['login']);
        if(stripos($login,'@')){
          if ($error = $this->mUser->checkEmailError($login)) {
              $errors[] = $error;
          }
        }else{
          if ($error = $this->mUser->checkPhoneError($login)) {
              $errors[] = $error;
          }
        }

        $user_password = htmlspecialchars($_POST['user_password']);
        if ($error = $this->mUser->checkPasswordError($user_password)) {
            $errors[] = $error;
        }

				if (empty($errors)) {
					if(is_array($this->mUser->auth(array(':login'=>$login,':login2'=>$login,':password'=>$user_password)))){
            header("Location: /cabinet/");

          }else{
            view('head.php');
            echo "авторизация не пройдена";
          }

				} else {
          view(compact('errors','login'),'head.php','auth.php','bottom.php');
				}
			}
      view(compact('errors','login'),'head.php','auth.php','bottom.php');
			return true;
		}



		public function logout() {
			unset($_SESSION['user']);
			header("Location: /");
		}

		public function edit() {
			if ($this->mUser->isLogged()) {
				header("Location: /");
			} else {
				$user_id = $_SESSION['user_id'];
				$user_info = $this->mUser->getUserById($user_id);
        view(compact('user_id','user_info'),'edit.php');
				return true;
			}

		}

		public function save() {
			if (isset($_POST['firstname'])) {
				// Обработка формы на странице edit.php - сохранение значений в базу.
				$result = User::insertDataInDb($array);
				//$firstname = $_POST['firstname'];
				//$lastname =
			}


		}

}
