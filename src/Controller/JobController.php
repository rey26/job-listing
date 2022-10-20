<?php

namespace App\Controller;

use App\Service\DtoService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * main application controller handling requests for each route so far
 */
class JobController extends AbstractController
{
    #[Route('/')]
    public function index(DtoService $dtoService, LoggerInterface $logger)
    {
        try {
            return $this->render('job/list.html.twig', ['jobs' => $dtoService->getJobList()]);
        } catch (Throwable $t) {
            $logger->error($t->getMessage());

            return new Response('An error ocurred, try again later', 500);
        }
    }
}
