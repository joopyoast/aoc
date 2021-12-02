<?php

require_once __DIR__ . '/boot.php';


$movements = \App\Logic\Movements::fromFile( __DIR__ . '/input/puzzle2.txt' );
$position = \App\Logic\Position::zero();

$movements->map(fn(\App\Logic\Movement $movement) => $position->move($movement));

echo $position->getHorizontal() * $position->getDepth();



