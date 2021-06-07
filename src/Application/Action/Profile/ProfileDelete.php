<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Action\Profile;

use ProfilesApi\Application\Service\Profile\ProfileDeleteRequest;
use ProfilesApi\Application\Service\Profile\ProfileDeleteService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileDelete
{
    /**
     * @var ProfileDeleteService
     */
    private $service;
    /**
     * @param ProfileDeleteService $service
     */
    public function __construct(ProfileDeleteService $service)
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
        $result = $this->service->execute(new ProfileDeleteRequest(
            (int) $id
        ));

        if ($result === true) {
            return $response->withStatus(200);
        } else {
            return $response->withJson($result);
        }
    }
}
