<?php

namespace App\Factory;

use App\Entity\Picture;
use DateTime;

/**
 * Represent Picture factory
 * Class PictureFactory
 * @package App\Factory
 */
class PictureFactory
{

    /**
     * Create new Picture from APOD array
     * @param array $data
     * @return Picture
     * @throws \Exception
     */
    public function createFromApodArray(array $data): ?Picture
    {
        //check if media is a picture
        if ("image" !== $data['media_type']) {
            return null;
        }
        $picture = new Picture();

        if (isset($data['title'])) {
            $picture->setTitle($data['title']);
        }
        if (isset($data['date'])) {
            $picture->setDate(DateTime::createFromFormat('Y-m-d', $data['date']));
        }
        if (isset($data['explanation'])) {
            $picture->setExplanation($data['explanation']);
        }
        if (isset($data['url'])) {
            $picture->setImage($data['url']);
        }
        return $picture;
    }
}
