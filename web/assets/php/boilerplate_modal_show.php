<?php
require_once __DIR__ . '/Boilerplate.php';

$boilerplate_category = $_POST["boilerplate_category"];
$modal_type = $_POST["modal_type"];
$boilerplate = new Boilerplate($boilerplate_category);
$data = $boilerplate->getLastModal($modal_type);
print json_encode($data, JSON_UNESCAPED_SLASHES);