<?php

namespace Stats\Stat;

class Population extends Base
{
	public function magnitudes()
	{
		return array(
			self::MAG_MILLIONS,
			self::MAG_BILLIONS
		);
	}

	public function silly_stat()
	{
		// Some various populations:
		$pops = array(
			'United Kingdom' => 62641000
		);

		return array(
			'country' => 'United Kingdom',
		);
	}
}