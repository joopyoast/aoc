<?php
declare( strict_types=1 );

namespace Test;

use App\Logic\PuzzleFour\Board;
use App\Logic\PuzzleFour\Game;
use App\Logic\PuzzleFour\Number;
use PHPUnit\Framework\TestCase;

final class Puzzle4Test extends TestCase {
	public function testBingo() {
		$game = new Game( [
			new Board( [
				[
					new Number( 22 ),
					new Number( 13 ),
					new Number( 17 ),
					new Number( 11 ),
					new Number( 0 ),
				],
				[
					new Number( 8 ),
					new Number( 2 ),
					new Number( 23 ),
					new Number( 4 ),
					new Number( 24 ),
				],
				[
					new Number( 21 ),
					new Number( 9 ),
					new Number( 14 ),
					new Number( 16 ),
					new Number( 7 ),
				],
				[
					new Number( 6 ),
					new Number( 10 ),
					new Number( 3 ),
					new Number( 18 ),
					new Number( 5 ),
				],
				[
					new Number( 1 ),
					new Number( 12 ),
					new Number( 20 ),
					new Number( 15 ),
					new Number( 19 ),
				],
			] ),
			new Board( [
				[
					new Number( 3 ),
					new Number( 15 ),
					new Number( 0 ),
					new Number( 2 ),
					new Number( 22 ),
				],
				[
					new Number( 9 ),
					new Number( 18 ),
					new Number( 13 ),
					new Number( 17 ),
					new Number( 5 ),
				],
				[
					new Number( 19 ),
					new Number( 8 ),
					new Number( 7 ),
					new Number( 25 ),
					new Number( 23 ),
				],
				[
					new Number( 20 ),
					new Number( 11 ),
					new Number( 10 ),
					new Number( 24 ),
					new Number( 4 ),
				],
				[
					new Number( 14 ),
					new Number( 21 ),
					new Number( 16 ),
					new Number( 12 ),
					new Number( 6 ),
				],
			] ),
			new Board( [
				[
					new Number( 14 ),
					new Number( 21 ),
					new Number( 17 ),
					new Number( 24 ),
					new Number( 4 ),
				],
				[
					new Number( 10 ),
					new Number( 16 ),
					new Number( 15 ),
					new Number( 9 ),
					new Number( 19 ),
				],
				[
					new Number( 18 ),
					new Number( 8 ),
					new Number( 23 ),
					new Number( 26 ),
					new Number( 20 ),
				],
				[
					new Number( 22 ),
					new Number( 11 ),
					new Number( 13 ),
					new Number( 6 ),
					new Number( 5 ),
				],
				[
					new Number( 2 ),
					new Number( 0 ),
					new Number( 12 ),
					new Number( 3 ),
					new Number( 7 ),
				],
			] )
		] );

		$drwawings = explode( ',', '7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1' );

		foreach ( $drwawings as $draw ) {
			$game->draw( (int)$draw );
			if (($board = $game->winningBoard()) !== null) {
				self::assertSame( 4512, $game->getLastDrawnNumber() * $board->score() );
				break;
			}
		}

	}
}
