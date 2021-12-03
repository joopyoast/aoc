<?php
declare( strict_types=1 );

namespace App\Logic;

final class OxygenGenerator {

	/** @var BitRate[] */
	private array $bitRates;

	public function __construct(array $bitRates) {
		$this->bitRates = $bitRates;
	}

	public function rating(): BitRate
	{
		$ratings = $this->bitRates;
		$round = 1;
		while (count($ratings) > 1) {
			$ones = 0;
			$zeros = 0;
			$carry = 0;
			foreach ($ratings as $rating) {
				$digit = $rating->getDiget($round);
				$ones = $digit === 1 ? $ones + 1 : $ones;
				$zeros = $digit === 0 ? $zeros + 1 : $zeros;
			}

			if ($ones >= $zeros) {
				$carry = 1;
			}

			$ratings = array_filter($ratings, static fn ( BitRate $bitRate) => $bitRate->digitIs($carry, $round));
			++$round;
		}
		return end($ratings);
	}
}
