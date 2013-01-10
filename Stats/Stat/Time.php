<?php

namespace Stats\Stat;

class Time extends Base
{
	public function magnitudes()
	{
		return array(
			self::MAG_THOUSANDS,
			self::MAG_MILLIONS
		);
	}

	public function silly_stat()
	{
		// Assume that time is in minutes, otherwise we overflow quite nicely.
		$total_time = $this->number * 60;

		$words_per_minute = 150;

		$tasks = array(
			'Walk around the Earth' => (833.333 * 24 * 60),
			'Read all of Shakespear' => (884421 * $words_per_minute),
			// 'Read all of Wikipedia' => (1798000000 * $words_per_minute),
		);

		// Work out how many times they could accomplish this:
		$rand_key = array_rand($tasks);
		$task_time = $tasks[$rand_key];
		
		$times_completed = round($total_time / $task_time, 3);

		return array(
			'task' => $rand_key,
			'unit' => 'Times',
			'times_completed' => $times_completed,
			'total_time' => $total_time
		);
	}
}