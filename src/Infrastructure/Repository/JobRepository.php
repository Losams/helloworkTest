<?php 

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\JobRepositoryInterface;
use App\Infrastructure\Api\Jobijoba\JobijobaService;
use App\Infrastructure\Api\Jobijoba\Request\ListJobsByCityRequest;

class JobRepository implements JobRepositoryInterface
{
    public function __construct (
        private JobijobaService $jobijobaService
    ) {
    }

    public function getJobsFromCity(string $city, int $page): array {
        $request = new  ListJobsByCityRequest($city, $page);

        $response = $this->jobijobaService->send($request);

        return [
            'total' => $response->getBody()['data']['total'],
            'jobs' => $response->getBody()['data']['ads']
        ];
    }
}
