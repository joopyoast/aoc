<?php
declare( strict_types=1 );

namespace App\Logic\PuzzleFour;

interface WinningStrategy {
	public function draw(array $boards, int $draw): void;

	public function winningBoard(): ?Board;

	public function getLastDrawnNumber(): ?int;
}
