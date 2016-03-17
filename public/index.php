<?php

try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
		'../app/classes/',
    ))->register();

	/*$loader->registerNamespaces(array(
		'utils' => '../app/classes/utils.php',
	))->register();
	*/
	
    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();

    //Set the database service
    $di->set('db', function(){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "localhost",
            "username" => "okna",
            "password" => "oknarjkfivjkf123",
            "dbname" => "okna",
			"options" => array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			)
        ));
    });
	

    //Setting up the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });
	
	$di->set(
		'utils',
		function () { 
			return Utils::getInstance();
		}
	);
	
	$di->set(
		'php_excel',
		function () { 
			return new PHPExcel();
		}
	);
	
	$di->set('router', function(){
		require __DIR__.'/../app/config/routes.php';
		return $router;
	});
	
	

	
    //Handle the request
    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);
    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
