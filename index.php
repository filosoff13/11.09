<?php

require_once __DIR__.'/vendor/autoload.php';
use Dev\Database;

$config = require_once 'config.php';
//print_r($config);

$db = new Database($config);

$query = $db->query('SELECT requests.id, offers.name, requests.price, requests.count count, operators.name op_name FROM requests LEFT JOIN offers ON requests.offer_id = offers.id LEFT JOIN operators ON requests.operator_id = operators.id WHERE count > 2 AND requests.operator_id in (10, 12)');
// print_r($query);

// $db->closeConnection();
?>
<table border="1">
    <p>Первый вариант</p>
    <tr>
        <th> Номер заказа </th>
        <th> Имя товара </th>
        <th> Цена </th>
        <th> Количество </th>
        <th> Имя оператора </th>
    </tr>

    <?php foreach ($query as $value) {?>
        <tr>
            <th> <?=$value['id']?> </th>
            <th> <?=$value['name']?> </th>
            <th> <?=$value['price']?> </th>
            <th> <?=$value['count']?> </th>
            <th> <?=$value['op_name']?> </th>
        </tr>
    <?php } ?>
</table>

<?php
$query = $db->query('SELECT SUM(requests.count) count, SUM(requests.price) price, offers.name name FROM requests LEFT JOIN offers ON offers.id = requests.offer_id GROUP BY name');
// print_r($query);

$db->closeConnection();
?>
<table border="1">
    <p>Второй вариант</p>
    <tr>
        <th> Имя товара </th>
        <th> Количество товара </th>
        <th> Сумма </th>
    </tr>

    <?php foreach ($query as $value) {?>
        <tr>
            <th> <?=$value['name']?> </th>
            <th> <?=$value['count']?> </th>
            <th> <?=$value['price']?> </th>
        </tr>
    <?php } ?>