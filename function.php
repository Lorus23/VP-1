<?php
require_once('config/db.php');
$email = $_POST['email'];
$phone = $_POST['phone'];
$name = $_POST['name'];
$street = $_POST['street'];
$home = $_POST['home'];
$part = $_POST['part'];
$appt = $_POST['appt'];
$floor = $_POST['floor'];
$comment = $_POST['comment'];
$payment1 = $_POST['payment1'];
$payment2 = $_POST['payment2'];
$callback = $_POST['callback'];
$array = $_POST;


function checkEmailExists($email)
{
    // Соединение с БД
    $db = Db::getConnection();

    // Текст запроса к БД
    $sql = 'SELECT * FROM users WHERE email = :email';

    // Получение результатов. Используется подготовленный запрос
    $result = $db->prepare($sql);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result->execute();
    return $result->fetch();
}

function register($email, $phone, $name)
{
    // Соединение с БД
    $db = Db::getConnection();

    // Текст запроса к БД
    $sql = 'INSERT INTO users (username, email, phone) VALUES (:name, :email, :phone)';

    // Получение и возврат результатов. Используется подготовленный запрос
    $result = $db->prepare($sql);
    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->bindParam(':phone', $phone, PDO::PARAM_STR);
    return $result->execute();
}

function zakaz($id, $array)
{
    print_r($array);
    // Соединение с БД
    $db = Db::getConnection();

    // Текст запроса к БД
    $sql = 'INSERT INTO `order_burger` (`user_id`, `street`, `home`, `part`, `appt`, `floor`, `comment`, `payment1`,'.
        '`payment2`, `callback`) VALUES (:user_id, :street, :home, :part, :appt, :floor, :comment, :payment1, :payment2, :callback)';

    // Получение и возврат результатов. Используется подготовленный запрос
    $result = $db->prepare($sql);
    $result->bindParam(':user_id', $id, PDO::PARAM_INT);
    $result->bindParam(':street', $array['street'], PDO::PARAM_STR);
    $result->bindParam(':home', $array['home'], PDO::PARAM_INT);
    $result->bindParam(':part', $array['part'], PDO::PARAM_STR);
    $result->bindParam(':appt', $array['appt'], PDO::PARAM_INT);
    $result->bindParam(':floor', $array['floor'], PDO::PARAM_INT);
    $result->bindParam(':comment', $array['comment'], PDO::PARAM_STR);
    $result->bindParam(':payment1', $array['payment1'], PDO::PARAM_STR);
    $result->bindParam(':payment2', $array['payment2'], PDO::PARAM_STR);
    $result->bindParam(':callback', $array['callback'], PDO::PARAM_STR);

    return $result->execute();
}

if (checkEmailExists($email)) {
    echo 'Такой пользователь зарегистрирован!';
    zakaz($result['id'], $array);


} else {
    register($email, $phone, $name);
    zakaz($result['id'], $array);
}


