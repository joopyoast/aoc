<?php

use App\Logic\BitRate;
use App\Logic\PowerConsumption;

require_once __DIR__ . '/boot.php';

$powerConsumption = new PowerConsumption(
	array_map(
		fn( string $bitRate ) => new BitRate( $bitRate ),
		explode( "\n", trim( file_get_contents( __DIR__ . '/input/puzzle3.txt' ) ) )
	)
);

echo $powerConsumption->toValue() . PHP_EOL;

echo $powerConsumption->lifeSupportRating() . PHP_EOL;

