<?php
declare(strict_types=1);

namespace Tests\Unit\User;

use Mockery;

use League\Fractal\Manager;
use ProfilesApi\Application\Request\Profile\ProfileAddRequest;
use ProfilesApi\Application\Request\Profile\ProfileDeleteRequest;
use ProfilesApi\Application\Request\Profile\ProfileUpdateRequest;
use ProfilesApi\Application\Request\Profile\ProfileViewRequest;
use ProfilesApi\Domain\Model\Profile\Profile;
use ProfilesApi\Infrastructure\Service\JsonTransformer;
use League\Fractal\Serializer\DataArraySerializer;
use ProfilesApi\Application\Service\ProfileService;

class ProfileServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Profile 
     */
    private $profile;

    /**
     * @var int 
     */
    private $profileId;

    /**
     * SetUp
     */
    public function setUp()
    {
        $this->profile = new Profile();
        $this->profile->setName('Test name');
        $this->profile->setAge(22);
        $this->profile->setBiography('Test bio');
        $this->profile->setProfileImage('Test image');

        $this->profileId = 1;
    }

    /** @test */
    public function testAdd()
    {
        $service = $this->getProfileService();
        $result = $service->add(new ProfileAddRequest(
            $this->profile->getName(),
            $this->profile->getAge(),
            $this->profile->getBiography(),
            $this->profile->getProfileImage()
        ));

        $this->assertSame($this->profile->getName(), $result['name']);
        $this->assertSame($this->profile->getAge(), $result['age']);
        $this->assertSame($this->profile->getBiography(), $result['biography']);
        $this->assertSame($this->profile->getProfileImage(), $result['profileImage']);
    }

    /** @test */
    public function testUpdate()
    {
        $service = $this->getProfileService();
        $result = $service->update(new ProfileUpdateRequest(
            1,
            $this->profile->getName(),
            $this->profile->getAge(),
            $this->profile->getBiography(),
            $this->profile->getProfileImage()
        ));

        $this->assertSame($this->profile->getName(), $result['name']);
        $this->assertSame($this->profile->getAge(), $result['age']);
        $this->assertSame($this->profile->getBiography(), $result['biography']);
        $this->assertSame($this->profile->getProfileImage(), $result['profileImage']);
    }

    /** @test */
    public function testView()
    {
        $service = $this->getProfileService();
        $result = $service->getOne(new ProfileViewRequest(
            1
        ));

        $this->assertSame($this->profile->getName(), $result['name']);
        $this->assertSame($this->profile->getAge(), $result['age']);
        $this->assertSame($this->profile->getBiography(), $result['biography']);
        $this->assertSame($this->profile->getProfileImage(), $result['profileImage']);
    }

    /** @test */
    public function testDelete()
    {
        $service = $this->getProfileService();
        $result = $service->delete(new ProfileDeleteRequest(
            1
        ));

        $this->assertTrue($result['success']);
    }

    /** @test */
    public function testList()
    {
        $service = $this->getProfileService();
        $result = $service->listAll();

        $this->assertSame($this->profile->getName(), $result[0]['name']);
        $this->assertSame($this->profile->getAge(), $result[0]['age']);
        $this->assertSame($this->profile->getBiography(), $result[0]['biography']);
        $this->assertSame($this->profile->getProfileImage(), $result[0]['profileImage']);
    }

    /** @test */
    public function testAverage()
    {
        $service = $this->getProfileService();
        $result = $service->ageAverage();

        $this->assertSame($this->profile->getAge(), $result['ageAverage']);
    }

    /**
     * @return ProfileService
     */
    private function getProfileService(): ProfileService
    {
        $mockedProfile = Mockery::mock('ProfilesApi\Domain\Model\Profile\Profile');
        $mockedProfile->shouldReceive('setName')->andReturn($this->profile);
        $mockedProfile->shouldReceive('getName')->andReturn($this->profile->getName());
        $mockedProfile->shouldReceive('setAge')->andReturn($this->profile);
        $mockedProfile->shouldReceive('getAge')->andReturn($this->profile->getAge());
        $mockedProfile->shouldReceive('setBiography')->andReturn($this->profile);
        $mockedProfile->shouldReceive('getBiography')->andReturn($this->profile->getBiography());
        $mockedProfile->shouldReceive('setProfileImage')->andReturn($this->profile);
        $mockedProfile->shouldReceive('getProfileImage')->andReturn($this->profile->getProfileImage());
        $mockedProfile->shouldReceive('getId')->andReturn($this->profileId);

        $mockEntityManager = Mockery::mock('Doctrine\ORM\EntityManager');
        $mockEntityManager->shouldReceive('getReference')->with("ProfilesApi\Domain\Model\Profile\Profile", $this->profileId)->andReturn($mockedProfile);

        $mockedRepository = Mockery::mock('ProfilesApi\Infrastructure\Domain\Model\Profile\DoctrineMysqlProfileRepository');
        $mockedRepository->shouldReceive([$mockEntityManager]);
        $mockedRepository->shouldReceive('findByName')->andReturn(false);
        $mockedRepository->shouldReceive('findById')->andReturn($mockedProfile);
        $mockedRepository->shouldReceive('findAll')->andReturn([$mockedProfile]);
        $mockedRepository->shouldReceive('add')->andReturn($mockedProfile);
        $mockedRepository->shouldReceive('update')->andReturn($mockedProfile);
        $mockedRepository->shouldReceive('delete')->andReturn(true);
        $mockedRepository->shouldReceive('getAgeAverage')->andReturn(22);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        return new ProfileService($mockedRepository, new JsonTransformer($manager));
    }

    public function tearDown() {
        Mockery::close();
    }
}
