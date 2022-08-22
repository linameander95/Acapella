<?php
$site_title = "Projekt";
$divider = " | ";
error_reporting(-1);
ini_set("display_errors", 1);

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php';
});
