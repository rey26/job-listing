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

    public function retrieveJobs(int $page): array
    {
        $response = $this->client->request('GET', 'api2/jobs', ['query' => ['page' => $page]]);
        $jobData = json_decode($response->getContent(), true);

        return [
            'code' => $jobData['meta']['code'],
            'jobs' => $jobData['payload'],
            'page' => ceil(($jobData['meta']['entries_from'] - 1) / $jobData['meta']['entries_sum']) + 1,
            'totalPages' => ceil($jobData['meta']['entries_total'] / $jobData['meta']['entries_sum']),
        ];
    }
}
