<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Action\Profile;

use ProfilesApi\Application\Service\Profile\ProfileAddRequest;
use ProfilesApi\Application\Service\Profile\ProfileAddService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileAdd
{
    /**
     * @var ProfileAddService
     */
    private $service;

    /**
     * @param ProfileAddService $service
     */
    public function __construct(ProfileAddService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args = []): ResponseInterface
    {
        $body = $request->getParsedBody();

        $result = $this->service->execute(new ProfileAddRequest(
            $body['name'],
            $body['age'],
            $body['biography'],
            $body['profileImage']
        ));

        if ($result === true) {
            return $response->withStatus(201);
        } else {
            return $response->withJson($result);
        }
    }
}
