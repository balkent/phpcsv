<?php

declare(strict_types=1);

require_once "bootstrap.php";

use App\Run;

Run::process($entityManager);
