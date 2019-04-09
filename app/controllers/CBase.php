<?php
namespace App\Controllers;

/**
 * Базовый контроллер, содержит функции отправки различных кодов ответов
 * Class CBase
 * @package App\Controllers
 */
abstract class CBase {

    protected $answer = [];

    abstract function main($id);

    // Отправка клиенту тела ответа в json формате
    protected function sendAnswer() {
        header('HTTP/1.1 200 OK');
        header('Content-type: application/json');
        echo json_encode($this->answer, JSON_UNESCAPED_UNICODE);
    }

    // Указанной страницы не существует
    protected function showNotFound() {
        header('HTTP/1.1 404 Not Found');
    }

    // Используемый метод не поддерживается
    protected function showNotAllowed() {
        header('HTTP/1.1 405 Method Not Allowed');
    }

    // Плохой запрос (переданы не все необходимые параметры)
    protected function showBadRequest($textError ="") {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('error'=>$textError) , JSON_UNESCAPED_UNICODE);
    }

    // Неверное значение token
    protected function showUnauthorized() {
        header('HTTP/1.1 401 Unauthorized');
    }

    // 500 ошибка сервера
    protected function showInternalError() {
        header('HTTP/1.1 500 Fatal');
    }
}