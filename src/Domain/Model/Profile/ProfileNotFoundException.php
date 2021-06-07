<?php
declare(strict_types=1);

namespace ProfilesApi\Domain\Model\Profile;

use ProfilesApi\Domain\Exception\NotFoundException;
use Throwable;

class ProfileNotFoundException extends \Exception implements NotFoundException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Profile not found";
        parent::__construct($message, $code, $previous);
    }
}
