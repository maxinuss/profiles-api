<?php
declare(strict_types=1);

namespace ProfilesApi\Domain\Exception;

interface DomainException
{
    public function message();
}
