<?php
declare(strict_types=1);

namespace ProfilesApi\Domain\Model\Profile;

interface ProfileRepository
{
    /**
     * @param Profile $profile
     */
    public function add(Profile $profile);

    /**
     * @param Profile $profile
     */
    public function update(Profile $profile);

    /**
     * @param Profile $profile
     */
    public function delete(Profile $profile);

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @return mixed
     */
    public function getAgeAverage();

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function findByName(string $name);

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function findById(int $id);
}
