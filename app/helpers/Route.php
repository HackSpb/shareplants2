<?php
namespace App\Helpers;



class Route
{

    private static $patterns = [
        "App\Controllers\CCatalog" => [
            "#^" . SUBSERVER . "/?$#",
            "#^" . SUBSERVER . "(catalog)/([0-9]*).*$#",
            "#^" . SUBSERVER . "index\..*$#",
          ],
          "App\Controllers\CAdvert" => [
              "#^" . SUBSERVER . "(form_advert)/([0-9]*).*$#",
              "#^" . SUBSERVER . "(save_advert)/([0-9]*).*$#",
              "#^" . SUBSERVER . "(advert)/([0-9]*).*$#",
              "#^" . SUBSERVER . "(edit_advert)/([0-9]*).*$#",
              "#^" . SUBSERVER . "(archive)/([0-9]*).*$#",
          ],
          "App\Controllers\CInfo" => [
              "#^" . SUBSERVER . "info/([0-9A-z_-]*)/.*$#",
            ],
          "App\Controllers\CUser" => [
              "#^" . SUBSERVER . "(register)/.*$#",
              "#^" . SUBSERVER . "(auth)/.*$#",
              "#^" . SUBSERVER . "(logout)/.*$#",
              "#^" . SUBSERVER . "(edit)/.*$#",
              "#^" . SUBSERVER . "(cabinet)/.*$#",

            ],
          "App\Controllers\CFeedback" => [
                "#^" . SUBSERVER . "(feedback)/.*$#",
              ],
        "Error" => [],
    ];

    public function start($url) {
        $id = 0;
        foreach (self::$patterns as $class => $list) {
            foreach ($list as $pattern) {
                if (preg_match($pattern, $url, $info)) {
                    $action = isset($info[1]) ? $info[1] : '';
                    $id = isset($info[2]) ? (int)$info[2] : 0;

                    break 2;
                }
            }
        }
        if ($class != 'Error') {
            $obj = new $class();
            $obj->main($action, $id);
        } else {
           header('HTTP/1.1 404 Not Found');
           echo "ошибка запроса!";
        }
    }
}
