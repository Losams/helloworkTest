<?php 

declare(strict_types=1);

namespace App\Infrastructure\Api\Jobijoba;

use Symfony\Contracts\HttpClient\ResponseInterface;

class JobijobaResponse
{
    public function __construct(
        private ResponseInterface $response
    ) {
    }

    public function getBody(): array
    {
        return $this->response->toArray();
    }
}
