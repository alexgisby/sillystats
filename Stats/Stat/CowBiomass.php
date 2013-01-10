<?php

namespace Stats\Stat;

/**
 * Uses a cows biomass to generate a statistic
 *
 */
class CowBiomass extends Base
{
	public function magnitudes()
	{
		return array(
			self::MAG_HUNDREDS,
			self::MAG_THOUSANDS
		);
	}

	public function silly_stat()
	{
		return array(
			'country' => 'United Kingdom',
			'animal' => 'Cow',
		);
	}
}