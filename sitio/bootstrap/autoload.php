<?php
spl_autoload_register(function(string $className) {
	$className = substr($className, 8); 

	$classPath = __DIR__ . '/../classes/';

	$classFilepath = $classPath . $className . '.php';

	if(file_exists($classFilepath)) {
		require_once $classFilepath;
	}
});