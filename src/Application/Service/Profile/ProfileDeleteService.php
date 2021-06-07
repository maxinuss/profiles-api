<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Service\Profile;

use ProfilesApi\Domain\Model\Profile\ProfileRepository;

class ProfileDeleteService
{
    /**
     * @var ProfileRepository
     */
    private $profileRepository;

    /**
     * ProductListService constructor.
     * @param ProfileRepository $profileRepository
     */
    public function __construct(
        ProfileRepository $profileRepository
    ) {
        $this->profileRepository = $profileRepository;
    }

    /**
     * @param ProfileDeleteRequest $request
     *
     * @return array|bool
     */
    public function execute(ProfileDeleteRequest $request)
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
}
