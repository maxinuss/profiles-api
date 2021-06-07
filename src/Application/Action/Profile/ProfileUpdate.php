<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Action\Profile;

use ProfilesApi\Application\Service\Profile\ProfileUpdateRequest;
use ProfilesApi\Application\Service\Profile\ProfileUpdateService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileUpdate
{
    /**
     * @var ProfileUpdateService
     */
    private $service;
    /**
     * @param ProfileUpdateService $service
     */
    public function __construct(ProfileUpdateService $service)
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

        $result = $this->service->execute(new ProfileUpdateRequest(
            (int) $id,
            $body['name'],
            $body['age'],
            $body['biography'],
            $body['profileImage']
        ));

        if ($result === true) {
            return $response->withStatus(200);
        } else {
            return $response->withJson($result);
        }
    }
}
