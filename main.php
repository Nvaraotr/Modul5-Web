<?php
header("Content-Type: application/json; charset=UTF-8");
include "app/Routes/PharmacyRoutes.php";
include "app/Routes/MedicineRoutes.php";

use app\Routes\PharmacyRoutes;
use app\Routes\MedicineRoutes;
// TANGKAP REQUEST METHOD
$method = $_SERVER[ 'REQUEST_METHOD' ];
// TANGKAP REQUEST PATH
$path = parse_url($_SERVER['REQUEST_URI' ], PHP_URL_PATH);
// PANGGIL ROUTES

$productRoute = new PharmacyRoutes();
$productRoute->handle($method, $path);

$productRoute = new MedicineRoutes();
$productRoute->handle($method, $path);

// php -S localhost:8000 main.php

?>
