<?php
declare(strict_types=1);

namespace ProfilesApi\Infrastructure\Transformer;

use ProfilesApi\Domain\Model\Profile\Profile;
use League\Fractal\TransformerAbstract;

class ProfileBodyTransformer extends TransformerAbstract
{
    /**
     * @param Profile $profile
     * @return array
     */
    public function transform(Profile $profile)
    {
        return [
            'id' => $profile->getId(),
            'name' => $profile->getName(),
            'age' => $profile->getAge(),
            'biography' => $profile->getBiography(),
            'profileImage' => $profile->getProfileImage()
        ];
    }
}


