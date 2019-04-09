<?php
# Настройки БД
define('HOST', "localhost");
define('USER', "root");
define('PASS', "");
define('DB',   "share_plants");


#Настройки сайта

define('ADMIN_EMAIL',   "test@test.ru");
define('TEMPLATES_DIR',   "./templates/default/");

# Определение путей
define('DIR',  pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME) . '/');
define('SCHEME', (is_null($_SERVER['REQUEST_SCHEME']) ? 'http' : $_SERVER['REQUEST_SCHEME']) . '://');
define('SERVER', $_SERVER['SERVER_NAME'] . '/');
//на случай если наш движок лежит в отдельной подпапке на сервере
define('SUBSERVER', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) != '' ? str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) . '/' : '/');
//начало для ссылок
define('MAIN',  SCHEME . str_replace('//', '/', SERVER . SUBSERVER));

# Основная секция
define('MODEL',      DIR  . 'api/models/');
define('CONTROLLER', DIR  . 'api/controllers/');
