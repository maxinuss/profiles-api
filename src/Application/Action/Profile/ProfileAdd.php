<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Action\Profile;

use ProfilesApi\Application\Request\Profile\ProfileAddRequest;
use ProfilesApi\Application\Service\ProfileService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileAdd
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
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args = []): ResponseInterface
    {
        $body = $request->getParsedBody();

        $result = $this->service->add(new ProfileAddRequest(
            $body['name'],
            $body['age'],
            $body['biography'],
            $body['profileImage']
        ));

        return $response->withJson($result);
    }
}
