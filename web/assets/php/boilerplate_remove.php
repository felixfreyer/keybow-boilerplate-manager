<?php
require_once __DIR__ . '/Boilerplate.php';

$boilerplate_id = isset($_REQUEST['boilerplate_id'])?$_REQUEST['boilerplate_id']:"";
$boilerplate_category = isset($_REQUEST['boilerplate_category'])?$_REQUEST['boilerplate_category']:"";
$boilerplate_position = isset($_REQUEST['boilerplate_position'])?$_REQUEST['boilerplate_position']:"";

$boilerplate = new Boilerplate($boilerplate_category);
$boilerplate->removeBoilerplate($boilerplate_id);

print json_encode($boilerplate_position);