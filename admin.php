<?php

require_once('function.php');

echo '<h5>';
echo 'Cписок всех зарегистрированных пользователей';
echo users();
echo '<br>';
echo 'Cписок всех заказов';
echo orders();

