<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

try {
// replace with file to your own project bootstrap
require_once '/application/bootstrap/app.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $app['em'];

return ConsoleRunner::createHelperSet($entityManager);
} catch(Exception $e) {
exit();
}
