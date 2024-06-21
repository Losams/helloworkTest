<?php
declare(strict_types=1);

namespace App\Presentation\Web\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Domain\UseCase\GetListJobsUseCase;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

#[Route('/', name: 'homepage')]
class HomepageAction extends AbstractController
{
    public function __construct(private GetListJobsUseCase $getListJobsUseCase)  {
    }

    public function __invoke(
        #[MapQueryParameter] int $page = 1
    ): Response
    {
        $usecase = $this->getListJobsUseCase->execute($page);

        $total = $usecase['total'];
        $jobs = $usecase['jobs'];
        
        return $this->render('homepage.html.twig', [
            'total' => $total,
            'jobs' => $jobs
        ]);
    }
}
