<?php
require_once __DIR__ . '/Boilerplate.php';

$boilerplate_a        = isset($_REQUEST['boilerplate_a'])?$_REQUEST['boilerplate_a']:"";
$boilerplate_b        = isset($_REQUEST['boilerplate_b'])?$_REQUEST['boilerplate_b']:"";
$boilerplate_category = isset($_REQUEST['boilerplate_category'])?$_REQUEST['boilerplate_category']:"";
$i_mode         = isset($_REQUEST['i_mode'])?$_REQUEST['i_mode']:"";

$boilerplate = new Boilerplate($boilerplate_category);
$boilerplate->swapBoilerplate($boilerplate_a, $boilerplate_b);

print json_encode($i_mode);