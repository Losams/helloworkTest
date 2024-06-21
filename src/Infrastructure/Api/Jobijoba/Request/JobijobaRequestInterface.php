<?php 

declare(strict_types=1);

namespace App\Infrastructure\Api\Jobijoba\Request;

interface JobijobaRequestInterface
{
    public function getMethod(): string;

    public function getParams(): array;
}
