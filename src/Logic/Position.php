<?php
declare( strict_types=1 );

namespace App\Logic;

use Closure;

final class Position {

	private int $horizontal;
	private int $depth;

	public static function zero(): Position {
		return new self(0, 0);
	}

	public function __construct(int $horizontal, int $depth) {
		$this->horizontal = $horizontal;
		$this->depth = $depth;
	}

	public function move( Movement $movement ): void {
		$this->moverFor($movement)($movement->velocity());
	}

	private function moverFor( Movement $movement ): Closure {
		return $movement->isForward()
			? fn (int $velocity) => $this->horizontal += $velocity
			: fn (int $velocity) => $this->depth += $velocity;
	}

	public function getHorizontal(): int {
		return $this->horizontal;
	}

	public function getDepth(): int {
		return $this->depth;
	}
}
