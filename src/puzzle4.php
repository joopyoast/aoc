<?php

use App\Logic\PuzzleFour\Board;
use App\Logic\PuzzleFour\Game;
use App\Logic\PuzzleFour\Number;

require_once __DIR__ . '/boot.php';

$foo = explode("\n", file_get_contents( __DIR__ . '/input/puzzle4.txt' ) );

$drawings = explode(',', array_shift($foo));

$numbers = [];
$index = 0;
$boards = [];
foreach ($foo as $bar) {
	if ($bar === '') {
		$numbers = [];
		$index = 0;
		continue;
	}
	++$index;
	$row = explode(' ', $bar);
	foreach ( $row as $number) {
		$numbers[$index][] = new Number((int)$number);
	}
	$boards[] = new Board(array_values($numbers));
}

$game = new Game( $boards );

foreach ( $drawings as $draw ) {
	$game->draw( (int)$draw );
	if (($board = $game->winningBoard()) !== null) {
		echo 'Wnner with score ' . $game->getLastDrawnNumber() * $board->score() . PHP_EOL;
		break;
	}
}
