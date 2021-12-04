<?php
declare( strict_types=1 );

namespace App\Logic\PuzzleFour;

final class Number {

	private int $number;
	private bool $marked = false;

	public function __construct( int $number ) {
		$this->number = $number;
	}

	public function asInt(): int {
		return $this->number;
	}

	public function isMarked(): bool {
		return $this->marked;
	}

	public function mark(int $draw): Number {
		if ($this->isMarked()) {
			return $this;
		}
		$this->marked = $this->number === $draw;
		return $this;
	}
}
