<?php
require_once __DIR__ . '/Boilerplate.php';

$boilerplate_id = $_POST["boilerplate_id"];
$boilerplate_name = $_POST["boilerplate_name"];
$boilerplate_code = $_POST["boilerplate_code"];
$boilerplate_category = $_POST["boilerplate_category"];
$boilerplate = new Boilerplate($boilerplate_category);
$boilerplate->updateBoilerplate($boilerplate_id, $boilerplate_name, $boilerplate_code);