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
$array1 = $_POST;


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
    $id = $result->fetch();
    if ($id) {
        return $id['id'];} else {
        return false;}
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

    //Execute the statement and insert our values.
    $inserted = $result->execute();

    if ($inserted) {
        echo 'Row inserted!';
    }
    return $id = $db->lastInsertId();
}

function zakaz($array1, $id)
{

    // Соединение с БД
    $db = Db::getConnection();

    // Текст запроса к БД
    $sql = "INSERT INTO `order_burger` (`user_id`, `street`, `home`, `part`, `appt`, `floor`, `comment`, `payment1`,`payment2`, `callback`) VALUES (:user_id, :street, :home, :part, :appt, :floor, :comment, :payment1, :payment2, :callback)";
    $result = $db->prepare($sql);

    // Получение и возврат результатов. Используется подготовленный запрос
    $values = (object)$array1;
    $result->bindParam(':user_id', $id);
    $result->bindParam(':street', $values->street);
    $result->bindParam(':home', $values->home);
    $result->bindParam(':part', $values->part);
    $result->bindParam(':appt', $values->appt);
    $result->bindParam(':floor', $values->floor);
    $result->bindParam(':comment', $values->comment);
    $result->bindParam(':payment1', $values->payment1);
    $result->bindParam(':payment2', $values->payment2);
    $result->bindParam(':callback', $values->callback);
    return $result->execute();
}
if (checkEmailExists($email)) {
    $id = checkEmailExists($email);
    zakaz($array1,$id);
} else {
    $id = register($email, $phone, $name);
    zakaz($array1, $id);
}

