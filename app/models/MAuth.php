<?php
namespace App\Models;

/**

CREATE TABLE `auth_app` (
  `id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `application` char(32) NOT NULL,
  `apikey` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `auth_app` (`id`, `token`, `application`, `apikey`) VALUES
(1, 'vk4954lbvqz59kxcclslvy3iukv31u11', 'test', 'test');

*/


class MAuth extends DBConnect
{
    const TABLE_NAME = 'auth_app';

    // Метод для генерации токена доступа для приложения
    public function getToken($ID, $key) {
        $qb = $this->qb
            ->select(['*'])
            ->from(self::TABLE_NAME)
            ->where('application = :app')
            ->andWhere('apikey = :apikey')
            ->setParameter('apikey', $key)
            ->setParameter('app', $ID);
        $check = $qb->execute()
            ->fetch();
        if (!empty($check)){
            $token = $this->generateToken(32);
            $update = $this->qb
                ->update(self::TABLE_NAME)
                ->set('token', ':token')
                ->where('id = :id')
                ->setParameter('id', $check['id'])
                ->setParameter('token', $token)
                ->execute();
            if($update === 1){
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Проверка актуальности данных
    public function checkToken($token) {
        $check = $this->qb
            ->select(['*'])
            ->from(self::TABLE_NAME)
            ->where('token = :token')
            ->setParameter('token', $token)
            ->execute()
            ->fetch();
        if(isset($check['id'])){
            return true;
        } else {
            return false;
        }
    }

    private function generateToken($size){

        $str = "abcdefghijklmnopqrstuvwxyz0123456789";
        $hash = "";
        for ($i = 0; $i < $size; $i++) {
            $hash .= $str[rand(0, 35)];
        }
        return $hash;
    }
}