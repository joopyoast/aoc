<?php
declare( strict_types=1 );

namespace App\Logic\PuzzleFour;

final class Game {
	/** @var Board[] */
	private array $boards;
	private ?int $lastDrawnNumber = null;
	/** @var Board|mixed */
	private mixed $winningBoard = null;

	public function __construct( array $boards ) {
		$this->boards = $boards;
	}

	public function draw( int $draw ): void {
		$this->lastDrawnNumber = $draw;
		foreach ($this->boards as $boardKey => $board) {
			$board->stamp( $draw );
			if ($board->hasBingo()) {
				$this->winningBoard = $board;
				break;
			}
		}
	}

	public function getLastDrawnNumber(): int {
		return $this->lastDrawnNumber ?: 0;
	}

	public function winningBoard(): ?Board
	{
		return $this->winningBoard;
	}
}
