<?php
declare(strict_types=1);

namespace ProfilesApi\Application\Action\Profile;

use ProfilesApi\Application\Service\Profile\ProfileViewRequest;
use ProfilesApi\Application\Service\Profile\ProfileViewService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProfileView
{
    /**
     * @var ProfileViewService
     */
    private $service;

    /**
     * @param ProfileViewService $service
     */
    public function __construct(ProfileViewService $service)
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
        $result = $this->service->execute(new ProfileViewRequest(
            (int) $id
        ));

        if ($result === true) {
            return $response->withStatus(200);
        } else {
            return $response->withJson($result);
        }
    }
}
