<?php

declare(strict_types=1);

require_once "bootstrap.php";

use App\Run;

$run = new Run();
$run->process($entityManager);
