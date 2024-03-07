<?php

namespace App;

use App\Entity\User;
use App\Builder\CsvBuilder;
use Doctrine\ORM\EntityManager;

class Run
{
    public const PUBLIC_PATH = __DIR__.'/../public';
    public const UPLOADS_PATH = self::PUBLIC_PATH.'/Uploads';

    public function process(EntityManager $entityManager): void
    {
        $jsonSchema = <<<JSON
		[
			{
				"header": "id",
				"field": "id"
			},
			{
				"header": "first name",
				"field": "firstname"
			},
			{
				"header": "last name",
				"field": "name"
			}
		]
		JSON;

        $productRepository = $entityManager->getRepository(User::class);
        $users = $productRepository->findAll();

        $csvBuilder = new CsvBuilder();
        $csvBuilder->build(
            self::UPLOADS_PATH.'/file.csv',
            $jsonSchema,
            $users
        );
    }
}
