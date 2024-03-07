<?php

namespace App;

use App\Entity\User;
use League\Csv\Writer;
use Doctrine\ORM\EntityManager;

class Run
{
	const PUBLIC_PATH = __DIR__.'/../public';
	const UPLOADS_PATH = self::PUBLIC_PATH.'/Uploads';

	public function process(EntityManager $entityManager): void
	{
		$productRepository = $entityManager->getRepository(User::class);
		$users = $productRepository->findAll();

		$header = ['id', 'first name', 'last name'];

		$writer = Writer::createFromPath(self::UPLOADS_PATH.'/file.csv', 'r+');
		$writer->insertOne($header);
		foreach ($users as $user) {
			$writer->insertOne([
				$user->getId(),
				$user->getFirstname(),
				$user->getName(),
			]);
		}
	}
}
