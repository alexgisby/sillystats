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
$generator->original_stat($_GET['users'], 'Users Online');
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
