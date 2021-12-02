<?php
spl_autoload_register(function (string $className) {
	$parts = explode("\\", $className);
	$fileName = __DIR__ . '/' . implode('/', array_slice($parts, 1)) . '.php';
	if (file_exists($fileName)) {
		require_once $fileName;
	}
});
