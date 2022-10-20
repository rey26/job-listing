<?php

namespace App\Controller;

use App\Service\DtoService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * main application controller handling requests for each route so far
 */
class JobController extends AbstractController
{
    #[Route('/')]
    public function index(DtoService $dtoService, Request $request, LoggerInterface $logger)
    {
        try {
            $jobData = $dtoService->getJobList($request->get('page', 1));

            return $this->render('job/list.html.twig', [
                'jobs' => $jobData['jobs'],
                'page' => $jobData['page'],
                'totalPages' => $jobData['totalPages'],
            ]);
        } catch (Throwable $t) {
            $logger->error($t->getMessage());

            return new Response('An error ocurred, try again later', 500);
        }
    }
}
