<?php
// replace with file to your own project bootstrap
include_once (__DIR__.'/bootstrap.php');
use Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet($oDBEntityManager);
?>