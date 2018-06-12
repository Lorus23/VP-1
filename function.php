<?php
require_once('config/db.php');
session_start();


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
    $_SESSION['username'] = $id['username'];

    if ($id) {
        return $id['id'];
    } else {
        return false;
    }
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
    $result->execute();

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
    $result->execute();
    return $orderId = $db->lastInsertId();
}

function fileOrder($orderId, $address, $orderCount)
{
    if ($orderCount == 0) {
        $orderCount = 'первый';
    }
    $handle = 'file.html';
    $content = '<table border="1">
        <tr><th>Заказ №' . $orderId . '</th>></tr>' .
        '<tr><td>Ваш заказ будет доставлен по адресу ' . $address . '</td></tr>' .
        '<tr><td>DarkBeefBurger за 500 рублей, 1 шт</td></tr>' .
        '<tr><td>Спасибо - это ваш ' . $orderCount . ' заказ</td></tr>' .
        '</table>';
    file_put_contents($handle, $content);
    header('Location: index.php');
}

function users()
{
    // Соединение с БД
    $db = Db::getConnection();
    // Текст запроса к БД
    $sql = 'SELECT username, email, phone FROM users';

    // Получение результатов. Используется подготовленный запрос
    $result = $db->prepare($sql);
    $result->execute();
    echo '<table border="2"> <tr>';
    echo '<tr>    <th>Имя пользователя</th>    <th>Электронная почта</th>    <th>Телефон</th>  </tr>';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Оператором echo выводим на экран поля таблицы name_blog и text_blog
        echo '<tr>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

function orders()
{
// Соединение с БД
    $db = Db::getConnection();
    // Текст запроса к БД
    $sql = 'SELECT user_id, street, home, part, appt, floor, comment, payment1, payment2, callback FROM order_burger';

    // Получение результатов. Используется подготовленный запрос
    $result = $db->prepare($sql);
    $result->execute();
    echo '<table border="2" > <tr>';
    echo '<tr>    <th>Имя пользователя</th>    <th>Улица</th>    <th>Дом</th> <th>Корпус</th> <th>Квартира</th> <th>Этаж</th> <th>Комментарий</th> <th>Потребуется сдача
</th> <th>Оплата по карте</th> <th>Не перезванивать</th>  </tr>';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Оператором echo выводим на экран поля таблицы name_blog и text_blog
        echo '<tr>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . $row['street'] . '</td>';
        echo '<td>' . $row['home'] . '</td>';
        echo '<td>' . $row['part'] . '</td>';
        echo '<td>' . $row['appt'] . '</td>';
        echo '<td>' . $row['floor'] . '</td>';
        echo '<td>' . $row['comment'] . '</td>';
        echo '<td>' . $row['payment1'] . '</td>';
        echo '<td>' . $row['payment2'] . '</td>';
        echo '<td>' . $row['callback'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

function getOrderCount($email)
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
        return $id['orderCount'];
    } else {
        return false;
    }
}

function updateOrderCount($email)
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

    $orderId = $id['orderCount'] + 1;
    $sqlUpdate = 'UPDATE `users` SET `orderCount`=' . $orderId . ' WHERE `id`=' . $id['id'];

// Получение результатов. Используется подготовленный запрос
    $result1 = $db->prepare($sqlUpdate);
    $result1->setFetchMode(PDO::FETCH_ASSOC);
    $result1->execute();
    $result1->fetch();
    return $result1;
}


//Основной блок выполнения кода

$email = $_POST['email'];
$phone = $_POST['phone'];
$name = $_POST['name'];
$street = $_POST['street'];
$home = $_POST['home'];
$part = $_POST['part'];
$appt = $_POST['appt'];
$floor = $_POST['floor'];
$comment = $_POST['comment'];

if ($_POST['payment1']) {
    $_POST['payment1'] = 'Yes';
} else {
    $_POST['payment1'] = 'No';
}

if ($_POST['payment2']) {
    $_POST['payment2'] = 'Yes';
} else {
    $_POST['payment2'] = 'No';
}
if ($_POST['callback']) {
    $_POST['callback'] = 'Yes';
} else {
    $_POST['callback'] = 'No';
}
$array1 = $_POST;
$address = 'Улица: ' . $street . ' Дом: ' . $home . ' Корпус: ' . $part . ' Квартира: ' . $appt . ' Этаж: ' . $floor;

if (checkEmailExists($email)) {
    $id = checkEmailExists($email);
    $orderCount = getOrderCount($email);
    $orderId = zakaz($array1, $id);
    fileOrder($orderId, $address, $orderCount + 1);
    updateOrderCount($email);

} else {
    $id = register($email, $phone, $name);
    $orderCount = getOrderCount($email);
    $orderId = zakaz($array1, $id);
    fileOrder($orderId, $address, $orderCount + 1);
    updateOrderCount($email);
}
