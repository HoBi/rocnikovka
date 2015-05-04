<?php
session_start();
mb_internal_encoding("UTF-8");
spl_autoload_register("autoLoad");

function autoLoad($class)
{
    if (preg_match("/Controller$/", $class))
        require("controllers/" . $class . ".php");
    else
        require("models/" . $class . ".php");
}


Db::logIn("127.0.0.1", "root", "", "tellus");
//Db::login("","HB_rocnikovka", "rocnikovy-projekt", "HB_rocnikovka");

Url::init();

$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->printView();