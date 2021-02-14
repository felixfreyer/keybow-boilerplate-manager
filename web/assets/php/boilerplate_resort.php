<?php
require_once __DIR__ . '/Boilerplate.php';

$boilerplate_category = isset($_REQUEST['boilerplate_category'])?$_REQUEST['boilerplate_category']:"";
$i_mode         = isset($_REQUEST['i_mode'])?$_REQUEST['i_mode']:"";

$boilerplate = new Boilerplate($boilerplate_category);
$boilerplate->resortBoilerplates();

print json_encode($i_mode);