<?php 
declare(strict_types=1);

namespace App\Infrastructure\Api\Jobijoba\Request;

use App\Infrastructure\Api\Jobijoba\Request\JobijobaRequestInterface;

class ListJobsByCityRequest implements JobijobaRequestInterface
{
    // TODO TRAIT ? 
    const METHOD = 'GET';

    public function __construct(
        private string $city,
        private int $page
    ) {
    }

    public function getMethod(): string {
        return self::METHOD;
    }

    public function getParams(): array {
        return [
            'page' => $this->page,
            'city' => $this->city
        ];
    }
}
