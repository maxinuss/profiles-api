<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Action\Profile;

use ProfilesApi\Application\Request\Profile\ProfileDeleteRequest;
use ProfilesApi\Application\Service\ProfileService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileDelete
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
        $result = $this->service->delete(new ProfileDeleteRequest(
            (int) $id
        ));

        return $response->withJson($result);
    }
}
