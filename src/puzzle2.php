<?php

use App\Logic\Movement;
use App\Logic\Movements;
use App\Logic\Position;

require_once __DIR__ . '/boot.php';

$movements = Movements::fromFile( __DIR__ . '/input/puzzle2.txt' );
$position = Position::zero();
$movements->map(fn( Movement $movement) => $position->move($movement));

echo $position->getHorizontal() * $position->getDepth();
