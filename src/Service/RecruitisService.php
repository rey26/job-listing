<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * A service retrieving data from external (Recruitis) API
 * @package App\Service
 */
class RecruitisService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client, string $url, string $token)
    {
        $this->client = $client->withOptions([
            'base_uri' => $url,
            'auth_bearer' => $token,
        ]);
    }

    public function retrieveJobs(): array
    {
        $response = $this->client->request('GET', 'api2/jobs');
        $jobData = json_decode($response->getContent(), true);

        return $jobData;
    }
}
