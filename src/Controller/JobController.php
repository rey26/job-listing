<?php

namespace App\Controller;

use App\Service\RecruitisService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * main application controller handling requests for each route so far
 */
class JobController extends AbstractController
{
    #[Route('/')]
    public function index(RecruitisService $recruitisService)
    {
        $recruitisService->retrieveJobs();
    }
}
