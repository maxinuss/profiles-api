<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Service\Profile;

use ProfilesApi\Application\Service\Profile\ProfileAddRequest;
use ProfilesApi\Domain\Model\Profile\Profile;
use ProfilesApi\Domain\Model\Profile\ProfileRepository;
use ProfilesApi\Infrastructure\Service\JsonTransformer;
use ProfilesApi\Infrastructure\Transformer\ProfileBodyTransformer;

class ProfileAddService
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
    public function execute(ProfileAddRequest $request)
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
}
