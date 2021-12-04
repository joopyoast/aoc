<?php

use App\Logic\PuzzleFour\Board;
use App\Logic\PuzzleFour\Game;
use App\Logic\PuzzleFour\IWantToWinWinningStrategy;
use App\Logic\PuzzleFour\LetSquidFaceWin;
use App\Logic\PuzzleFour\Number;

require_once __DIR__ . '/boot.php';

$foo = explode("\n", file_get_contents( __DIR__ . '/input/puzzle4.txt' ) );

$drawings = explode(',', array_shift($foo));

$numbers = [];
$boards = [];
$index = 0;
$numbers[$index] = [];
$blocks = [[]];
$blockIndex = 0;
foreach ($foo as $bar) {
	if ($bar === '') {
		++$index;
		$blocks[$index] = [];
		$blockIndex = 0;
		continue;
	}
	$row = explode(' ', $bar);
	foreach ( $row as $number) {
		$blocks[$index][$blockIndex][] = new Number((int)$number);
	}
	++$blockIndex;
}

foreach ($blocks as $index => $block) {
	$boards[] = new Board($block);
}


$game = new Game( $boards, new IWantToWinWinningStrategy());

foreach ( $drawings as $draw ) {
	$game->draw( (int)$draw );
	if (($board = $game->winningBoard()) !== null) {
		echo 'Winner with score ' . $game->getLastDrawnNumber() * $board->score() . PHP_EOL;
		break;
	}
}

$game = new Game( $boards, new LetSquidFaceWin( $boards ));

foreach ( $drawings as $draw ) {
	$game->draw( (int)$draw );
}
echo 'Squid winner with score ' . $game->getLastDrawnNumber() * $game->winningBoard()->score() . PHP_EOL;
