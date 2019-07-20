<?php

require '../../database/definitions.php';

$sizes = json_decode(urldecode($_GET['sizes']));
$id_order = $_GET['id'];

$price = 0;
foreach ($sizes as $key => $value) {
    $type_sizes = getAll('types_sizes', ['name', 'price', 'id_type_prints'], ['id' => $sizes[$key]->id_types]);

    $price = $price + (int)$type_sizes[0]['price'] * (int)$sizes[$key]->counts;
}

include('checkout.php');