<?php

namespace App\Tests\Factory;

use App\Factory\UserFactory;
use DateTimeInterface;
use League\OAuth2\Client\Provider\GoogleUser;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    public function testLoadingUserDataFromExistingGoogleUserAccount(): void
    {
        $googleUserData = [
            'name' => 'DemoName',
            'email' => 'mike.selby@exemple.com'
        ];
        $googleUser = new GoogleUser($googleUserData);
        $userFactory = new UserFactory($googleUser);
        $user = $userFactory->createFromGoogleUser($googleUser);
        $this->assertEquals($googleUser->getEmail(), $googleUserData['email']);
        $this->assertEquals($googleUser->getEmail(), $user->getEmail());
        $this->assertEquals($googleUser->getName(), $user->getFullname());
        $this->assertEquals($googleUser->getName(), $googleUserData['name']);
        $this->assertInstanceOf(DateTimeInterface::class, $user->getCreatedAt());
    }

    public function testLoadingUserDataFromEmptyGoogleUserAccountData(): void
    {
        $googleUserData = [
            'name' => '',
            'email' => ''
        ];
        $googleUser = new GoogleUser($googleUserData);
        $userFactory = new UserFactory($googleUser);
        $user = $userFactory->createFromGoogleUser($googleUser);
        $this->assertEquals(null, $user);
    }
}
