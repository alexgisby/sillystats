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
			'Canada' => 34482779, // Low mills
			'China' => 1344130000, // Low Bills
			'United Kingdom' => 62641000, // Mid Mills
			'United States' => 313914040, // High Mills,
		);

		asort($pops);

		$country = '';
		$under_or_over = '';
		$pop_values = array_values($pops);
		$pop_keys = array_keys($pops);
		foreach($pop_values as $i => $pop_value)
		{
			$current = $pop_values[$i];
			$next = (isset($pop_values[$i + 1]))? $pop_values[$i + 1] : false;

			if(!$next || $this->number < $current)
			{
				// End of the list:
				$country = $pop_keys[$i];
				$under_or_over = ($current >= $this->number)? 'under' : 'over';
				break;
			}
			else
			{
				if($current <= $this->number && $this->number <= $next)
				{
					// Inbetween brackets:
					$country = $pop_keys[$i];
					$under_or_over = 'over';
					break;
				}
				else
				{
					// Under current?
					$country = $pop_keys[$i];
					$under_or_over = ($current <= $this->number)? 'under' : 'over';
				}
			}
		}

		return array(
			'country' => $country,
			'under_or_over' => $under_or_over,
			'unit' => 'People',
		);
	}
}