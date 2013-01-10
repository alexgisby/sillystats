<?php

namespace Stats;
use \Stats\Stat\Base as StatBase;

/**
 * Stat generation class. Takes the original number and converts
 * it into a funny stat, based on the Stat objects passed in.
 */
class Generator
{
	/**
	 * @var 	array 	Available stats
	 */
	protected $stats = array();

	/**
	 * @var 	numeric The stat we're converting
	 */
	 protected $number = 0;

	 /**
	  * @var 	string 	The original units
	  */
	 protected $units = '';

	 /**
	  * Constructor
	  *
	  * Pass in the available stat instances
	  *
	  * @param 	array 	Array of stat object instances
	  * @return 	this
	  */
	 public function __construct(array $stats = array())
	 {
	 	$this->stats = $stats;
	 }

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

	 /**
	  * Fetching a random stat out of the system
	  *
	  * @return 	Stat
	  */
	 public function random_stat()
	 {
	 	// Find the magnitude of the current stat.
	 	$mags = array(
	 		StatBase::MAG_TENS,
	 		StatBase::MAG_HUNDREDS,
	 		StatBase::MAG_THOUSANDS,
	 		StatBase::MAG_MILLIONS,
	 		StatBase::MAG_BILLIONS
	 	);
	 	$original_mag = $mags[0];

	 	foreach($mags as $mag)
	 	{
	 		if($this->number <= $mag)
	 		{
	 			$original_mag = $mag;
	 			break;
	 		}
	 	}

	 	// Now loop through all the available stats, finding one that's appropriate to the
	 	// order of magnitude we're using.
	 	$appropriate_stats = array();
	 	foreach($this->stats as $stat)
	 	{
	 		if(in_array($original_mag, $stat->magnitudes()))
	 		{
	 			$appropriate_stats[] = $stat;
	 		}
	 	}

	 	if(count($appropriate_stats))
	 	{
	 		// Find a random subset of this:
	 		$index = rand(0, count($appropriate_stats) - 1);
	 		
	 		$appropriate_stats[$index]->original_stat($this->number, $this->units);
	 		return $appropriate_stats[$index];
	 	}

	 	return false;
	 }

}