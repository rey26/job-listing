<?php

namespace App\Tests\Integration\Service;

use App\Service\RecruitisService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RecruitisServiceTest extends KernelTestCase
{
    public function testExternalApiCall(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        /** @var RecruitisService $recruitisService */
        $recruitisService = $container->get(RecruitisService::class);

        $response = $recruitisService->retrieveJobs(1);

        $this->assertEquals('api.found', $response['code']);
    }
}
