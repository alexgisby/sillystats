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

$generator = new Stats\Generator(array(
	new Stats\Stat\Biomass(),
	// new Stats\Stat\Population()
));

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
