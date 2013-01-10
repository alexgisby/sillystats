<?php

//
// -------------- Setup -------------------
//
ini_set('display_errors', 'On');
spl_autoload_register(function($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
});
//
// -------------- END SETUP ---------------
//

//
// Pulling the data for a station
//
$url = 'SHHH ITS A SECRET';
$c = curl_init();
curl_setopt_array($c, array(
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_PROXY          => 'REITH PROXY HERE',
	CURLOPT_URL            => $url,
));
$response = curl_exec($c);
$lines = explode(PHP_EOL, $response);
$data_line = $lines[99];
$data_line = trim(str_replace('_lastLive = ', '', $data_line));
$listen_live_data = json_decode($data_line);
$radio_total = 0;
foreach($listen_live_data->channels as $channel)
{
	if(preg_match('/bbc_radio/i', $channel->channel))
	{
		$radio_total += $channel->views;
	}
}
$radio_total *= 7;

$stats = array();
if(isset($_GET['stats']))
{
	$exploded = explode(',', $_GET['stats']);
	foreach($exploded as $class)
	{
		$class = 'Stats\Stat\\' . $class;
		$stats[] = new $class();
	}
}
else
{
	$stats = array(
		new Stats\Stat\Biomass(),
		new Stats\Stat\Population(),
		new Stats\Stat\Time()
	);
}

$generator = new Stats\Generator($stats);
$generator->original_stat($radio_total, 'Users Online');
$stat = $generator->random_stat();

if($stat)
{
	echo $stat->to_json();
}
else
{
	echo json_encode($stat);
}

exit;
