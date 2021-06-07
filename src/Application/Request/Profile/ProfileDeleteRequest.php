<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Request\Profile;

class ProfileDeleteRequest
{
    /**
     * @var int
     */
    private $id;

    /**
     * ProfileDeleteRequest constructor.
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