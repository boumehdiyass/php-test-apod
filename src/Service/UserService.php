<?php

namespace App\Service;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Client\Provider\GoogleUser;

/**
 * Represent User service layer
 * Class UserService
 * @package App\Service
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var UserFactory
     */
    private UserFactory $userFactory;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserFactory $userFactory
    ) {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->userFactory = $userFactory;
    }

    /**
     * Create new User
     * @param GoogleUser $googleUser
     * @return User
     */
    public function loadFromGoogleUser($googleUser): ?User
    {
        $user = $this->getUserByEmail($googleUser->getEmail());
        if (!$user) {
            $user = $this->userFactory->createFromGoogleUser($googleUser);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
        return $user;
    }


    public function getUserByEmail($email)
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }
}
