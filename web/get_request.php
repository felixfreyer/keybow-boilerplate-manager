<?php
require_once __DIR__ . '/assets/php/Boilerplate.php';

$category = isset($_GET['category'])?$_GET['category']:"";
$sorting = isset($_GET['position'])?$_GET['position']:"";

$boilerplate = new Boilerplate('');
$categoriesArray = $boilerplate->getAllCategories();
$cat_str = $categoriesArray[(int)$category - 1]['category'];
$boilerplate = new Boilerplate($cat_str);
echo ($boilerplate->getCode($sorting));