<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Action\Profile;

use ProfilesApi\Application\Request\Profile\ProfileUpdateRequest;
use ProfilesApi\Application\Service\ProfileService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileUpdate
{
    /**
     * @var ProfileService
     */
    private $service;
    /**
     * @param ProfileService $service
     */
    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param int $id
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $id): ResponseInterface
    {
        $body = $request->getParsedBody();

        $result = $this->service->update(new ProfileUpdateRequest(
            (int) $id,
            $body['name'],
            $body['age'],
            $body['biography'],
            $body['profileImage']
        ));

        return $response->withJson($result);
    }
}
