<?php

namespace Stats\Stat;

/**
 * Stats Base Class
 */
abstract class Base
{
	/**
	 * @var 	numeric The stat we're converting
	 */
	 protected $number = 0;

	 /**
	  * @var 	string 	The original units
	  */
	 protected $units = '';

	/**
	 * Maginitude types
	 */
	const MAG_TENS = 10;
	const MAG_HUNDREDS = 100;
	const MAG_THOUSANDS = 1000;
	const MAG_MILLIONS = 1000000;
	const MAG_BILLIONS = 1000000000;

	/**
	 * Stats must implement this to say which amounts they support.
	 *
	 * @return 	array 	Return an array of constants
	 */
	abstract public function magnitudes();

	/**
	 * Setting the original stat to use
	 *
	 * @param 		numeric 	Source number
	 * @param 		string 		Units
	 * @return 	this
	 */
	public function original_stat($number, $units)
	{
		$this->number = $number;
		$this->units = $units;
		return $this;
	}

	public function to_json()
	{
		$silly = $this->silly_stat();
		$silly['type'] = str_replace('Stats\Stat\\', '', get_class($this));

		return json_encode(array(
			'original_stat' => array(
				'number' => $this->number,
				'units' => $this->units,
			),
			'silly_stat' => $silly
		));
	}

	abstract protected function silly_stat();

}