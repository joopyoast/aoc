<?php
declare( strict_types=1 );

namespace App\Logic\PuzzleFour;

final class Game {
	/** @var Board[] */
	private array $boards;
	private WinningStrategy $winningStrategy;

	public function __construct( array $boards, WinningStrategy $winningStrategy ) {
		$this->boards = $boards;
		$this->winningStrategy = $winningStrategy;
	}

	public function draw( int $draw ): void {
		$this->winningStrategy->draw($this->boards, $draw);
	}

	public function getLastDrawnNumber(): int {
		return $this->winningStrategy->getLastDrawnNumber() ?: 0;
	}

	public function winningBoard(): ?Board
	{
		return $this->winningStrategy->winningBoard();
	}
}
