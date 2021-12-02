<?php
declare( strict_types=1 );

namespace App\Logic;

final class Movement {

	private string $direction;
	private int $velocity;

	public static function fromString( string $movement ): Movement {
		$parts = explode( ' ', $movement );
		return new self($parts[0], (int)$parts[1]);
	}

	public function __construct(string $direction, int $velocity) {
		$this->direction = $direction;
		$this->velocity = $velocity;
	}

	public function velocity(): int {
		return $this->direction === 'up'
			? $this->velocity * -1
			: $this->velocity;
	}

	public function isForward(): bool {
		return $this->direction === 'forward';
	}
}
