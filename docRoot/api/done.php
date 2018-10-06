<?php

$week = isset($_POST["week"]) ? $_POST["week"] : null;
$authKey = $_SERVER["HTTP_AUTHKEY"];

var_dump($authKey);
var_dump($week);

?>