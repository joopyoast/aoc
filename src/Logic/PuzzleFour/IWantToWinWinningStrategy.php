<?php
declare( strict_types=1 );

namespace App\Logic\PuzzleFour;

final class IWantToWinWinningStrategy implements WinningStrategy {
	private ?Board $winningBoard = null;
	private ?int $lastDrawnNumber = null;

	public function draw( array $boards, int $draw ): void {
		$this->lastDrawnNumber = $draw;
		foreach ($boards as $board) {
			$board->stamp( $draw );
			if ($board->hasBingo()) {
				$this->winningBoard = $board;
				break;
			}
		}
	}

	public function winningBoard(): ?Board {
		return $this->winningBoard;
	}

	public function getLastDrawnNumber(): ?int {
		return $this->lastDrawnNumber;
	}
}
