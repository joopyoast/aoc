<?php
declare( strict_types=1 );

namespace App\Logic\PuzzleFour;

final class LetSquidFaceWin implements WinningStrategy {

	private ?int $lastDrawnNumber = null;
	private array $allBingos = [];
	private array $boards;

	public function __construct(array $boards ) {
		$this->boards = $boards;
	}

	public function draw( array $boards, int $draw ): void {
		foreach ($this->boards as $key => $board) {
			if ($board->hasBingo()) {
				continue;
			}
			$board->stamp( $draw );
			if ($board->hasBingo()) {
				$this->allBingos[] = $board;
				$this->lastDrawnNumber = $draw;
				unset($this->boards[$key]);
			}
		}
	}

	public function winningBoard(): ?Board {
		return end( $this->allBingos ) ?: null;
	}

	public function getLastDrawnNumber(): ?int {
		return $this->lastDrawnNumber;
	}
}
