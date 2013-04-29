<?php

$configLoaded = false;

/**
 * developing a package and symlink from vendor-dir to www
 *
 * @var array
 */
$configPaths = array(
  dirname(__DIR__) . "/www/config.php", 
  dirname(__DIR__) . "/../../../www/config.php", 
);
foreach ($configPaths as $configPath) {
  if (file_exists($configPath)) {
    include($configPath);
    $configLoaded = true;
  }
}
if (!$configLoaded) {
  echo "Could not determine a path to real config.php";
  die();
}
