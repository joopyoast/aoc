<?php

$measurements = explode("\n", file_get_contents( __DIR__ . '/input/puzzle1.txt' ));

echo count($measurements) . PHP_EOL;

/** @var MeasurementWindow[] $measurementWindows */
$measurementWindows = [];

final class MeasurementWindow {
	private array $measurements = [];

	public function isFull(): bool {
		return count($this->measurements) === 3;
	}

	public function hasRoom(): bool {
		return $this->isFull() === false;
	}

	public function add($measurement): void {
		if ($this->isFull()) {
			return;
		}
		$this->measurements[] = $measurement;
	}

	public function isHigherThan( MeasurementWindow $previousWindow ): bool {
		return array_sum($this->measurements) > array_sum($previousWindow->measurements);
	}
}

foreach ($measurements as $measurement) {
	$measurementWindows[] = new MeasurementWindow();
	foreach ( array_filter($measurementWindows, static fn ( MeasurementWindow $window) => $window->hasRoom()) as $measurementWindow) {
		$measurementWindow->add($measurement);
	}
}

echo count($measurementWindows) . PHP_EOL;

$previousWindow = null;
$increased = 0;
foreach ($measurementWindows as $window) {
	if ($previousWindow === null) {
		$previousWindow = $window;
		continue;
	}

	if ($window->isHigherThan($previousWindow)) {
		++$increased;
	}
	$previousWindow = $window;
}

echo $increased . PHP_EOL;
