<?php
require_once __DIR__ . '/Boilerplate.php';

$boilerplate_category = $_POST["boilerplate_category"];
$boilerplate = new Boilerplate($boilerplate_category);
$data = $boilerplate->getBoilerplatesModalsString();
print json_encode($data, JSON_UNESCAPED_SLASHES);