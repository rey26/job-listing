<?php

namespace App\Service;

use App\Exception\NoJobsFoundException;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * A service retrieving data from external (Recruitis) API
 * @package App\Service
 */
class RecruitisService
{
    private HttpClientInterface $client;

    private TagAwareCacheInterface $recruitisCache;

    public function __construct(
        HttpClientInterface $client,
        TagAwareCacheInterface $recruitisCache,
        string $url,
        string $token
    ) {
        $this->client = $client->withOptions([
            'base_uri' => $url,
            'auth_bearer' => $token,
        ]);
        $this->recruitisCache = $recruitisCache;
    }

    public function retrieveJobs(int $page): array
    {
        $response = $this->getCachedJobsData($page);
        $jobData = json_decode($response, true);

        if ($jobData['meta']['code'] === 'api.response.null') {
            throw new NoJobsFoundException('No jobs were found, try again later');
        }

        return [
            'code' => $jobData['meta']['code'],
            'jobs' => $jobData['payload'],
            'page' => $this->getPage($jobData['meta']['entries_from'], $jobData['meta']['entries_sum']),
            'totalPages' => $this->getTotalPages(
                $jobData['meta']['entries_total'],
                $jobData['meta']['entries_from'],
                $jobData['meta']['entries_to']
            ),
        ];
    }

    private function getCachedJobsData(int $page)
    {
        return $this->recruitisCache->get('job-list-' . $page, function (ItemInterface $item) use ($page) {
            $response = $this->client->request('GET', 'api2/jobs', ['query' => ['page' => $page]])->getContent();
            $item->expiresAfter(600);

            // @TODO use user ID for authenticated user
            $item->tag('user-1');

            return $response;
        });
    }

    private function getPage(int $entriesFrom, int $entriesSum): int
    {
        return floor(($entriesFrom - 1) / $entriesSum + 1);
    }

    private function getTotalPages(int $entriesTotal, int $entriesFrom, int $entriesTo): int
    {
        return ceil($entriesTotal / ($entriesTo - $entriesFrom + 1));
    }
}
