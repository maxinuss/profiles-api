<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Service\Profile;

use ProfilesApi\Domain\Model\Profile\ProfileRepository;
use ProfilesApi\Infrastructure\Service\JsonTransformer;
use ProfilesApi\Infrastructure\Transformer\ProfileListTransformer;

class ProfileListService
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
     * ProductListService constructor.
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
     * @return array
     */
    public function execute()
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
}
