<?php

namespace App;

use App\Entity\User;
use Doctrine\ORM\EntityManager;

class Run
{
	static public function process(EntityManager $entityManager): void
	{
		$productRepository = $entityManager->getRepository(User::class);
		$users = $productRepository->findAll();

		foreach ($users as $user) {
			var_dump($user);
		}
	}
}
