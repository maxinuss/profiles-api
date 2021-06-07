<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Request\Profile;

class ProfileUpdateRequest
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $age;

    /**
     * @var string
     */
    private $biography;

    /**
     * @var string
     */
    private $profileImage;

    /**
     * ProfileUpdateRequest constructor.
     * @param int $id
     * @param string $name
     * @param int $age
     * @param string $biography
     * @param string $profileImage
     */
    public function __construct(int $id, string $name, int $age, string $biography, string $profileImage)
    {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->biography = $biography;
        $this->profileImage = $profileImage;
    }

    /**
     * @return integer
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function age(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function biography(): string
    {
        return $this->biography;
    }

    /**
     * @return string
     */
    public function profileImage(): string
    {
        return $this->profileImage;
    }
}