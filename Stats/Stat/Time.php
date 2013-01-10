<?php

namespace Stats\Stat;

class Time extends Base
{
	public function magnitudes()
	{
		return array(
			self::MAG_TENS,
			self::MAG_HUNDREDS,
			self::MAG_THOUSANDS,
		);
	}

	public function silly_stat()
	{
		// Assume that time is in minutes, otherwise we overflow quite nicely.
		$total_time = $this->number;

		$tasks = array(
			'Walk around the Earth' => (833.333 * 24 * 60),
		);

		return array(
			'country' => $country,
			'under_or_over' => $under_or_over
		);
	}
}