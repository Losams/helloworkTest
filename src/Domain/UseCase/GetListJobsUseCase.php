<?php 

namespace App\Domain\UseCase;

use App\Domain\Repository\JobRepositoryInterface;

class GetListJobsUseCase
{
    public function __construct(private JobRepositoryInterface $jobRepository)
    {
    }

    public function execute(int $page = 1): Array
    {
        $result = $this->jobRepository->getJobsFromCity('Bordeaux', $page);

        return $result;
    }
}

