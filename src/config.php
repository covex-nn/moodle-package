<?php

$configLoaded = false;

$configPaths = array(
  dirname(__DIR__) . "/web/config.php",
  dirname(__DIR__) . "/../../../web/config.php",
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
unset($configLoaded);
unset($configPaths);
unset($configPath);
