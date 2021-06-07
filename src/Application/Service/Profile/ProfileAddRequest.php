<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Service\Profile;

class ProfileAddRequest
{
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
     * ProfileAddRequest constructor.
     * @param string $name
     * @param int $age
     * @param string $biography
     * @param string $profileImage
     */
    public function __construct(string $name, int $age, string $biography, string $profileImage)
    {
        $this->name = $name;
        $this->age = $age;
        $this->biography = $biography;
        $this->profileImage = $profileImage;
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