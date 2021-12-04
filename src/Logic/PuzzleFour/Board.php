<?php
declare( strict_types=1 );

namespace App\Logic\PuzzleFour;

final class Board {

	private array $numbers;

	public function __construct( array $numbers)
	{
		$this->numbers = $numbers;
	}

	public function stamp( int $draw ): void {
		array_map(
			fn (array $row) => array_map(
				fn (Number $number) => $number->mark($draw),
				array_filter(
					$row,
					fn (Number $number) => $number->isMarked() === false
				)
			),
			$this->numbers
		);
	}

	public function hasBingo(): bool {
		$columns = [];
		for ( $columnIndex = 0; $columnIndex < 5; $columnIndex++ ) {
			$columns[ $columnIndex ] = [];
			foreach ( $this->numbers as $row ) {
				$columns[ $columnIndex ][] = $row[ $columnIndex ];
			}
		}
		return $this->hasOneBingo( $this->numbers )
			|| $this->hasOneBingo($columns);
	}

	public function score(): int
	{
		return array_sum($this->getUnmarkedNumbers());
	}

	private function getUnmarkedNumbers(): array {
		$numbers = [[]];
		foreach ($this->numbers as $row) {
			$numbers[] = array_map(
				fn (Number $number) => $number->asInt(),
				array_filter(
					$row,
					fn (Number $number) => $number->isMarked() === false
				)
			);
		}
		return array_merge(...$numbers);
	}

	private function hasOneBingo(array $rows): bool {
		foreach ( $rows as $row) {
			$marked = count(
				array_filter(
					$row,
					fn( Number $number ) => $number->isMarked()
				)
			);
			if ($marked === 5) {
				return true;
			}
		}
		return false;
	}
}
