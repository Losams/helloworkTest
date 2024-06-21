<?php 

namespace App\Tests;

use App\Domain\Repository\JobRepositoryInterface;
use App\Domain\UseCase\GetListJobsUseCase;
use PHPUnit\Framework\TestCase;

class GetListJobsUseCaseTest extends TestCase
{
    public function testExecute(): void
    {
        $jobRepository = $this->createMock(JobRepositoryInterface::class);
        $jobRepository->expects(self::once())
            ->method('getJobsFromCity')
            ->willReturn([
                'jobs' => [],
                'total' => 10,
            ])
        ;

        $useCase = new GetListJobsUseCase($jobRepository);
        $useCase->execute();
    }
}
