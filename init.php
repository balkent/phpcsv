<?php

use Nelmio\Alice\Loader\NativeLoader;

require_once "bootstrap.php";

const FIXTURE_PATH = __DIR__.'/public/Fixtures';

exec('php bin/doctrine.php orm:schema-tool:drop --force');
exec('php bin/doctrine.php orm:schema-tool:create');

$loader = new NativeLoader();
$userFixtures = $loader->loadFile(FIXTURE_PATH.'/user.fixtures.yaml');

foreach ($userFixtures->getObjects() as $userFixture) {
	$entityManager->persist($userFixture);
}
$entityManager->flush();
