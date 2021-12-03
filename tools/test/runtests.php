#! /usr/bin/php
<?php

$testFolder = array_key_exists(1, $argv)
    ? $argv[1]
    : '-c tools/test/phpunit.xml.dist';

echo shell_exec("./vendor/bin/phpunit --bootstrap tools/test/bootstrap.php $testFolder --do-not-cache-result\n");
