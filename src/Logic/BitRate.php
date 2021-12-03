<?php
declare( strict_types=1 );

namespace App\Logic;

final class BitRate {

	private string $bitRate;

	public function __construct( string $bitRate) {
		$this->bitRate = $bitRate;
	}

	public function getNumberOfDigits(): int {
		return strlen($this->bitRate);
	}

	public function getDiget(int $digitNumber): int {
		return (int)$this->bitRate[$digitNumber - 1];
	}

	public function toDecimal(): int {
		return bindec($this->bitRate);
	}

	public function digitIs(int $digit, int $digitNumber): bool {
		return $this->getDiget($digitNumber) === $digit;
	}
}
