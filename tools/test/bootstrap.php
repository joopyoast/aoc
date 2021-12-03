<?php

$rootDir = dirname(__DIR__, 2);
require_once $rootDir . '/src/boot.php';

spl_autoload_register(static function ($className) use ($rootDir) {
    $parts = explode('\\', $className);
    $fileName = $rootDir. '/test/' . implode('/', array_slice($parts, 1)) . '.php';
	if (file_exists($fileName)) {
		require_once $fileName;
	}
});
