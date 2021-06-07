<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Service;

use ProfilesApi\Application\Request\Profile\ProfileAddRequest;
use ProfilesApi\Application\Request\Profile\ProfileDeleteRequest;
use ProfilesApi\Application\Request\Profile\ProfileUpdateRequest;
use ProfilesApi\Application\Request\Profile\ProfileViewRequest;
use ProfilesApi\Domain\Model\Profile\Profile;
use ProfilesApi\Domain\Model\Profile\ProfileRepository;
use ProfilesApi\Infrastructure\Service\JsonTransformer;
use ProfilesApi\Infrastructure\Transformer\ProfileBodyTransformer;
use ProfilesApi\Infrastructure\Transformer\ProfileListTransformer;

class ProfileService
{
    /**
     * @var ProfileRepository
     */
    private $profileRepository;

    /**
     * @var JsonTransformer
     */
    private $jsonTransformer;

    /**
     * ProfileAddService constructor.
     * @param ProfileRepository $profileRepository
     * @param JsonTransformer $jsonTransformer
     */
    public function __construct(
        ProfileRepository $profileRepository,
        JsonTransformer $jsonTransformer
    ) {
        $this->profileRepository = $profileRepository;
        $this->jsonTransformer = $jsonTransformer;
    }

    /**
     * @param ProfileAddRequest $request
     *
     * @return array|bool
     */
    public function add(ProfileAddRequest $request)
    {
        try {
            $profileExist = $this->profileRepository->findByName($request->name());
            if ($profileExist) {
                return ['error' => 'This profile already exists in our database.'];
            }

            $profile = new Profile();
            $profile->setName($request->name());
            $profile->setAge($request->age());
            $profile->setBiography($request->biography());
            $profile->setProfileImage($request->profileImage());

            $this->profileRepository->add($profile);
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

        return $this->jsonTransformer->formatItem($profile, new ProfileBodyTransformer());
    }

    /**
     * @param ProfileDeleteRequest $request
     *
     * @return array|bool
     */
    public function delete(ProfileDeleteRequest $request)
    {
        try {
            $profile = $this->profileRepository->findById($request->id());
            if (!$profile) {
                return ['error' => 'This profile does not exist in our database.'];
            }

            $this->profileRepository->delete($profile);
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

        return ['success' => true];
    }

    /**
     * @return array
     */
    public function listAll()
    {
        try {
            $profiles = $this->profileRepository->findAll();
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

        return $this->jsonTransformer->formatCollection($profiles, new ProfileListTransformer());
    }

    /**
     * @param ProfileUpdateRequest $request
     *
     * @return array|bool
     */
    public function update(ProfileUpdateRequest $request)
    {
        try {
            $profile = $this->profileRepository->findById($request->id());
            if (!$profile) {
                return ['error' => 'This profile does not exist in our database.'];
            }

            $profile->setName($request->name());
            $profile->setAge($request->age());
            $profile->setBiography($request->biography());
            $profile->setProfileImage($request->profileImage());

            $this->profileRepository->update($profile);
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

        return $this->jsonTransformer->formatItem($profile, new ProfileBodyTransformer());
    }

    /**
     * @param ProfileViewRequest $request
     *
     * @return array|bool
     */
    public function getOne(ProfileViewRequest $request)
    {
        try {
            $profile = $this->profileRepository->findById($request->id());
            if (!$profile) {
                return ['error' => 'This profile does not exist in our database.'];
            }

        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

        return $this->jsonTransformer->formatItem($profile, new ProfileBodyTransformer());
    }

    /**
     * @return array
     */
    public function ageAverage()
    {
        try {
            $ageAverage = $this->profileRepository->getAgeAverage();
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

        return ['ageAverage' => $ageAverage];
    }
}
