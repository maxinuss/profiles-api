<?php
declare(strict_types=1);

namespace ProfilesApi\Infrastructure\Domain\Model\Profile;

use ProfilesApi\Domain\Model\Profile\Profile;
use ProfilesApi\Domain\Model\Profile\ProfileRepository;
use ProfilesApi\Infrastructure\Domain\Model\DoctrineMysqlRepository;

class DoctrineMysqlProfileRepository extends DoctrineMysqlRepository implements ProfileRepository
{
    /**
     * @param Profile $profile
     * @return Profile
     */
    public function add(Profile $profile): Profile
    {
        $this->em->persist($profile);
        $this->em->flush();

        return $profile;
    }

    /**
     * @param Profile $profile
     * @return Profile
     */
    public function update(Profile $profile): Profile
    {
        $this->em->persist($profile);

        return $profile;
    }

    /**
     * @param Profile $profile
     */
    public function delete(Profile $profile)
    {
        $this->em->remove($profile);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->em->getRepository(Profile::class)->findBy([], ['id' => 'DESC']);
    }

    /**
     * @param int $id
     *
     * @return bool|mixed|object|null
     */
    public function findById(int $id)
    {
        $result = $this->em->getRepository(Profile::class)->findOneBy(['id' => $id]);

        return empty($result) ? false : $result;
    }

    /**
     * @param string $name
     *
     * @return bool|mixed|object|null
     */
    public function findByName(string $name)
    {
        $result = $this->em->getRepository(Profile::class)->findOneBy(['name' => $name]);

        return empty($result) ? false : $result;
    }

    /**
     * @param string $name
     *
     * @return bool|mixed|object|null
     */
    public function getAgeAverage()
    {
        $qb =  $this->em->createQueryBuilder();
        $qb->select('AVG(p.age) as average')
            ->from(Profile::class    , 'p');


        return empty($qb->getQuery()->getResult()) ? false : $qb->getQuery()->getResult()[0]['average'];
    }

}
