<?php 

declare(strict_types=1);

namespace App\Domain\Repository;

interface JobRepositoryInterface
{
    public function getJobsFromCity(string $city, int $page): array;
}
