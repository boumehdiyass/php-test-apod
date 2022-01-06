<?php

namespace App\Service;

use DateTime;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Represent Client NASA APOD API calls
 * Class ApodClientService
 * @package App\Service
 */
class ApodClientService
{
    /**
     * @var HttpClientInterface
     */
    private $client;
    private $url;
    private $apiKey;

    public function __construct(
        HttpClientInterface $client,
        string $apodUrl,
        string $apodApiKey
    ) {
        $this->client = $client;
        $this->url = $apodUrl;
        $this->apiKey = $apodApiKey;
    }

    /**
     * return one picture for specified date
     * if date not set use today by default
     * @param DateTime $date
     * @return array
     */
    public function fetchByDate(DateTime $date = null): array
    {
        $date = $date ? $date : new DateTime();
        try {
            $response = $this->client->request('GET', $this->url, [
                'query' => [
                    'api_key' => $this->apiKey,
                    'date' => $date->format('Y-m-d'),
                ],
            ]);
            return $response->toArray();
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }
    }
}
