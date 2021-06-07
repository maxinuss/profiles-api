<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Service\Profile;

class ProfileViewRequest
{
    /**
     * @var int
     */
    private $id;

    /**
     * ProfileViewRequest constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function id(): int
    {
        return $this->id;
    }
}