<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * A service retrieving data from external (Recruitis) API
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

    public function retrieveJobs()
    {
        $response = $this->client->request('GET', 'api2/jobs');
        dd($response->getContent());
    }
}
