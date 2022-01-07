<?php

namespace App\Tests\Factory;

use App\Factory\PictureFactory;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

class PictureFactoryTest extends TestCase
{
    public function testLoadingPictureWithImageType(): void
    {
        $pictureWithImageApod = [
            "copyright" => "Soumyadeep Mukherjee",
            "date" => "2022-01-01",
            "explanation" => "very Full Moon of 2021 shines in this year-spanning astrophoto project, a composite portrait of the familiar lunar nearside at each brightest lunar phase. Arranged by moonth, the year progresses in stripes beginning at the top. Taken with the same camera and lens the stripes are from Full Moon images all combined at the same pixel scale. The stripes still look mismatched, but they show that the Full Moon's angular size changes throughout the year depending on its distance from Kolkata, India, planet Earth. The calendar month, a full moon name, distance in kilometers, and angular size is indicated for each stripe. Angular size is given in minutes of arc corresponding to 1/60th of a degree. The largest Full Moon is near a perigee or closest approach in May. The smallest is near an apogee, the most distant Full Moon in December. Of course the full moons of May and November also slid into Earth's shadow during 2021's two lunar eclipses.",
            "hdurl" => "https://apod.nasa.gov/apod/image/2201/MoonstripsAnnotatedIG.jpg",
            "media_type" => "image",
            "service_version" => "v1",
            "title" => "The Full Moon of 2021",
            "url" => "https://apod.nasa.gov/apod/image/2201/MoonstripsAnnotatedIG_crop1024.jpg"
        ];
        $pictureFactory = new PictureFactory();
        $picture = $pictureFactory->createFromApodArray($pictureWithImageApod);
        $this->assertEquals($pictureWithImageApod['title'], $picture->getTitle());
        $this->assertEquals($pictureWithImageApod['url'], $picture->getImage());
        $this->assertEquals($pictureWithImageApod['explanation'], $picture->getExplanation());
        $this->assertInstanceOf(DateTimeInterface::class, $picture->getDate());
        $this->assertEquals($pictureWithImageApod['date'], $picture->getDate()->format('Y-m-d'));
    }

    public function testLoadingPictureWithVideoType(): void
    {
        $PictureWithVideoApod = [
            "copyright" => "Dani Caxete",
            "date" => "2022-01-02",
            "explanation" => "Sometimes falling ice crystals make the atmosphere into a giant lens causing arcs and halos to appear around the Sun or Moon. One Saturday night in 2012 was just such a time near Madrid, Spain, where a winter sky displayed not only a bright Moon but four rare lunar halos.  The brightest object, near the top of the featured image, is the Moon. Light from the Moon refracts through tumbling hexagonal ice crystals into a somewhat rare 22-degree halo seen surrounding the Moon. Elongating the 22-degree arc horizontally is a more rare circumscribed halo caused by column ice crystals. Even more rare, some moonlight refracts through more distant tumbling ice crystals to form a (third) rainbow-like arc 46 degrees from the Moon and appearing here just above a picturesque winter landscape. Furthermore, part of a whole 46-degree circular halo is also visible, so that an extremely rare -- especially for the Moon --  quadruple halo  was captured. Far in the background is a famous winter skyscape that includes Sirius, the belt of Orion, and Betelgeuse -- visible between the inner and outer arcs. Halos and arcs typically last for minutes to hours, so if you do see one there should be time to invite family, friends or neighbors to share your unusual lensed vista of the sky.",
            "hdurl" => "https://apod.nasa.gov/apod/image/2201/lunararcs_caxete_1280.jpg",
            "media_type" => "video",
            "service_version" => "v1",
            "title" => "Quadruple Lunar Halo Over Winter Road",
            "url" => "https://apod.nasa.gov/apod/image/2201/lunararcs_caxete_960.jpg"
        ];
        $pictureFactory = new PictureFactory();
        $notApicture = $pictureFactory->createFromApodArray($PictureWithVideoApod);
        $this->assertEquals(null, $notApicture);
    }
}
