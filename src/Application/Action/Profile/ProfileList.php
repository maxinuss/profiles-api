<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Action\Profile;

use ProfilesApi\Application\Service\Profile\ProfileListService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileList
{
    /**
     * @var ProfileListService
     */
    private $service;
    /**
     * @param ProfileListService $service
     */
    public function __construct(ProfileListService $service)
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
        $result = $this->service->execute();

        return $response->withJson($result);
    }
}
