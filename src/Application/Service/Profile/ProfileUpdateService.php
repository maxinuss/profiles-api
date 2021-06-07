<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Service\Profile;

use ProfilesApi\Domain\Model\Profile\ProfileRepository;
use ProfilesApi\Infrastructure\Service\JsonTransformer;
use ProfilesApi\Infrastructure\Transformer\ProfileBodyTransformer;

class ProfileUpdateService
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
     * ProfileUpdateService constructor.
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
     * @param ProfileUpdateRequest $request
     *
     * @return array|bool
     */
    public function execute(ProfileUpdateRequest $request)
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
}
