<?php
declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use ProfilesApi\Infrastructure\Application\TransactionalMiddleware;

$app->add(new TransactionalMiddleware(
    $app->getContainer()->get(EntityManagerInterface::class)
));