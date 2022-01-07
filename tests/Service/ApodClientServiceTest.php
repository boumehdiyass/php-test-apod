<?php

namespace App\Tests\Service;

use App\Service\ApodClientService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\CurlHttpClient;

class ApodClientServiceTest extends TestCase
{


    public function testFetchApodPicture(): void
    {
        $client = new CurlHttpClient();
        $apodClient = new ApodClientService($client, 'https://api.nasa.gov/planetary/apod', 'DEMO_KEY');
        $picture = $apodClient->fetchByDate();
        $this->assertIsArray($picture);
        $this->assertNotEmpty($picture['title']);
        $this->assertNotEmpty($picture['explanation']);
        $this->assertNotEmpty($picture['url']);
        $this->assertNotEmpty($picture['date']);
        $this->assertNotEmpty($picture['media_type']);
    }
}
