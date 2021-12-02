<?php
declare( strict_types=1 );

namespace App\Logic;

final class Movements {
	/** @var Movement[] */
	private array $movements;

	public static function fromFile( string $file) {
		return new self(
			array_map(
				fn (string $movement) => Movement::fromString($movement),
				explode("\n", trim(file_get_contents( __DIR__ . '/../input/puzzle2.txt' )))
			)
		);
	}

	public function __construct(array $movements) {
		$this->movements = $movements;
	}

	public function map( \Closure $map ): Movements {
		array_map($map, $this->movements);
		return $this;
	}
}
