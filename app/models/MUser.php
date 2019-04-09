<?php

namespace App\Models;

use App\Models\DBConnect;
use PDO;

class MUser
{
    private $db;

    function __construct()
    {
        $DBobj = new DBConnect();
        $this->pdo = $DBobj->connect();
    }
// функции ....Error в случае ошибки возвращают строку с оповещением об ошибке, если ошибки нет возвращает false.
    public static function checkNameError($login) {
           if (strlen($login) > 2) {
               return false;
           }
           return 'имя должно быть больше одного символа';
       }

       public static function checkPasswordError($password) {
           if (strlen($password) >= 7) {
               return false;
           }
           return 'Пароль должен быть длинее 6 символов';
       }

       public static function checkCityError($city) {
           if (is_numeric($city)) {
               return false;
           }
           return 'Некорректно введен город';
       }

       public static function checkPhoneError($phone) {
         if(!preg_match("|^[+]{1}[0-9]{1}\s?\({1}[0-9]{3}\){1}\s?[0-9]{3}[\-]{1}[0-9]{2}[\-]{1}[0-9]{2}$|", $phone)) {
                 return 'Некорректно введен телефон';
         }
       }
   	public function checkEmailError($email) {
      if(!preg_match("|^([a-z0-9_-]+\.)*[a-z0-9_-]+@([a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6})$|i", $email)) {
            return 'Некорректно введен E-mail';
        }

      $sql = 'SELECT count(*) AS count FROM `users`
              WHERE `user_email` = "$email"';

              $stmt = $this->pdo->query($sql);
              $result = $stmt->fetch(PDO::FETCH_ASSOC);

   		if ($result['count'] == 1) {
   			return 'Такой email уже занят';
   		}
   		return false;
   	}

   	public function register($user_firstname, $user_phone, $city_id, $user_password, $user_email) {
      $sql = "INSERT INTO `users`
      SET `user_firstname` = '$user_firstname',
        `user_password` = md5('$user_password'),
        `user_phone` = '$user_phone',
        `city_id` = '$city_id',
        `user_email` = '$user_email'";

        $stmt = $this->pdo->query($sql);

   		   	//	header("Location:" . DOMAIN . 'index');
   	}

   	public function validUser($login, $password) {
   		$db = Db::getConnection();
   		$result = $db->query("
   			SELECT `user_id` AS `id`
   			FROM `users`
   			WHERE `user_login` = :login
   			AND   `user_password` = md5(:password);
   		");
   		$result = $result->fetch();
   		if ($result['id']) {
   			return $result['id'];
   		} else {
   			return false;
   		}
   	}

   	public function auth($fields) {
      $sql = "
        SELECT u.*,  null as `user_password`
        FROM `users` as u
        WHERE (`user_email` = :login or `user_phone` = :login2)
        AND   `user_password` = md5(:password);
      ";

      //$this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
      $sth =  $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      try{
        $sth->execute($fields);
      }
      catch (PDOException $e) {
        return false;
      }
      //print_R($sth->debugDumpParams());
      //print_r($this->pdo->errorInfo());
      $result = $sth->fetch(PDO::FETCH_ASSOC);
   		if(is_array($result)){
        $_SESSION['user'] = $result;
        return $_SESSION['user'];
      }else return false;

   	}

   	public function isLogged() {
   		if (isset($_SESSION['user_id'])) {
   			return true;
   		}
   		return false;
   	}

   	public function getUserById($id) {
   		$db = Db::getConnection();
   		$result = $db->query("
   			SELECT *
   			FROM `users`
   			WHERE `user_id` = $id;
   		");
   		$result = $result->fetch();
   		return $result;
   	}

   	public static function insertDataInDb($arr) {

   	}



}
