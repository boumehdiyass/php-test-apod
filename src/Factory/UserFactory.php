<?php

namespace App\Factory;

use App\Entity\User;
use DateTime;
use League\OAuth2\Client\Provider\GoogleUser;

/**
 * Represent User factory
 * Class UserFactory
 * @package App\Factory
 */
class UserFactory
{

    /**
     * Create new User from GoogleUser
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function createFromGoogleUser(GoogleUser $googleUser): User
    {
        $user = new User();
        $user->setEmail($googleUser->getEmail());
        $user->setFullname($googleUser->getName());
        $user->setCreatedAt(new DateTime(date('Y-m-d H:i:s')));
        return $user;
    }
}
