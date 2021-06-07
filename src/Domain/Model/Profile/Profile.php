<?php
declare(strict_types=1);

namespace ProfilesApi\Domain\Model\Profile;

/**
 * Profile
 */
class Profile
{
    /**
     * @var integer
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
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Profile
     */
    public function setName(string $name) : Profile
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getAge() : int
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return Profile
     */
    public function setAge(int $age) : Profile
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return string
     */
    public function getBiography() : string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     * @return Profile
     */
    public function setBiography(string $biography) : Profile
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return string
     */
    public function getProfileImage() : string
    {
        return $this->profileImage;
    }

    /**
     * @param string $profileImage
     * @return Profile
     */
    public function setProfileImage(string $profileImage) : Profile
    {
        $this->profileImage = $profileImage;

        return $this;
    }
}

