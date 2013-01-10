<?php

namespace Stats\Stat;

/**
 * Uses a cows biomass to generate a statistic
 *
 */
class Biomass extends Base
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
		// Calculate the weight of humans:
		$human_weight = 77; // In kilos:
		$human_weight_total = ($this->number * $human_weight);

		// Lookup for the animal weights:
		$animals = array(
			'Spiders' => 0.001, // 1g
			'Killer Whales' => 9000, // 9 tons
			'Sheep' => 80, // 80kg
			'Great White Sharks' => 1900, // 1.9 Tonnes
			'Camels' => 700, // 700 Kilos
		);

		$rand_key = array_rand($animals, 1);
		$animal_weight = $animals[$rand_key];

		$animal_count = round($human_weight_total / $animal_weight, 2);

		return array(
			'animal' => $rand_key,
			'animal_count' => $animal_count,
			'animal_weight' => $animal_weight,
			'human_weight_total' => $human_weight_total,
		);
	}
}