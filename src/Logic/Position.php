<?php
declare( strict_types=1 );

namespace App\Logic;

use Closure;

final class Position {

	private int $horizontal;
	private int $depth;
	private int $aim;

	public static function zero(): Position {
		return new self(0, 0, 0);
	}

	public function __construct(int $horizontal, int $depth, int $aim) {
		$this->horizontal = $horizontal;
		$this->depth = $depth;
		$this->aim = $aim;
	}

	public function move( Movement $movement ): void {
		$this->moverFor($movement)($movement->velocity());
	}

	private function moverFor( Movement $movement ): Closure {
		return $movement->isForward()
			? fn (int $velocity) => $this->moveHorizontal($velocity)
			: fn (int $velocity) => $this->moveDepth($velocity);
	}

	public function getHorizontal(): int {
		return $this->horizontal;
	}

	public function getDepth(): int {
		return $this->depth;
	}

	private function moveHorizontal(int $velocity): void {
		$this->horizontal += $velocity;
		$this->depth += ( $velocity * $this->aim );
	}

	private function moveDepth(int $velocity): void {
		$this->aim += $velocity;
	}
}
