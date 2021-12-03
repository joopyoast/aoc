<?php
declare( strict_types=1 );

namespace App\Logic;

final class PowerConsumption {

	/** @var BitRate[] */
	private array $bitRates;

	public function __construct( array $bitRates) {
		$this->bitRates = $bitRates;
	}

	public function toValue(): float|int {
		[$gamma, $epsilon] = $this->calculate();
		return $gamma->toDecimal() * $epsilon->toDecimal();
	}

	/**
	 * @return BitRate[]
	 */
	private function calculate(): array {
		$totalDigits = end($this->bitRates)->getNumberOfDigits();
		$gammaRate = '';
		$epsilonRate = '';

		for ($i = 1; $i <= $totalDigits; $i++) {
			$ones = 0;
			$zeros = 0;
			foreach ($this->bitRates as $bitRate) {
				$digit = $bitRate->getDiget($i);
				$ones = $digit === 1 ? $ones + 1 : $ones;
				$zeros = $digit === 0 ? $zeros + 1 : $zeros;
			}

			if ($ones > $zeros) {
				$gammaRate .= '1';
				$epsilonRate .= '0';
			} else {
				$gammaRate .= '0';
				$epsilonRate .= '1';
			}
		}

		return [
			new BitRate($gammaRate),
			new BitRate($epsilonRate)
		];
	}

	public function lifeSupportRating(): float|int {
		$oxygenGenerator = new OxygenGenerator( $this->bitRates );
		$CO2Scrubber = new CO2Scrubber( $this->bitRates );
		return $oxygenGenerator->rating()->toDecimal() * $CO2Scrubber->rating()->toDecimal();
	}
}
