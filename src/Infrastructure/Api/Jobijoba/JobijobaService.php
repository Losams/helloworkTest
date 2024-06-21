<?php 

declare(strict_types=1);

namespace App\Infrastructure\Api\Jobijoba;

use Psr\Log\LoggerInterface;
use App\Infrastructure\Api\Jobijoba\JobijobaResponse;
use App\Infrastructure\Api\Jobijoba\Request\JobijobaRequestInterface;
use App\Infrastructure\Api\Jobijoba\JobijobaClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

class JobijobaService
{
    public function __construct(
        private LoggerInterface $logger,
        private JobijobaClient $client
    )
    {
    }

    public function send(JobijobaRequestInterface $request): JobijobaResponse
    {
        try {
            $response = $this->getRequestByMethod($request);

            return new JobijobaResponse($response);
        } catch (\Exception $exception) {
            // @TODO make a proper custom error handler

            $this->logger->error("JobijobaService: send error:".$exception->getMessage());
        }
    }

    private function getRequestByMethod(JobijobaRequestInterface $request): ResponseInterface
    {
        if ('GET' === $request->getMethod()) {
            return $this->client->get($request);
        }

        // TODO implement other methods

        // TODO make custom error handler
        throw new \Exception('Method not supported');
    }
}
