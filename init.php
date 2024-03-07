<?php

use Nelmio\Alice\Loader\NativeLoader;

require_once "bootstrap.php";

const PUBLIC_PATH = __DIR__.'/public';
const FIXTURE_PATH = PUBLIC_PATH.'/Fixtures';
const UPLOADS_PATH = PUBLIC_PATH.'/Uploads';

exec('touch '.UPLOADS_PATH.'/file.csv');
exec('php bin/doctrine.php orm:schema-tool:drop --force');
exec('php bin/doctrine.php orm:schema-tool:create');

$loader = new NativeLoader();
$userFixtures = $loader->loadFile(FIXTURE_PATH.'/user.fixtures.yaml');

foreach ($userFixtures->getObjects() as $userFixture) {
	$entityManager->persist($userFixture);
}
$entityManager->flush();
