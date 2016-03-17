<?php 

$router = new \Phalcon\Mvc\Router();


$router->add(
    "/admin",
    array(
		"controller" => "admin",
        "action"     => "index",
    )
);

$router->add(
    "/admin/login",
    array(
		"controller" => "admin",
        "action"     => "login",
    )
);

$router->add(
    "/admin/([a-zA-Z0-9\_\-]+)",
    array(
		"controller" => "admin",
        "action"     => "module",
        "moduleName" => 1,
    )
);


return $router;
