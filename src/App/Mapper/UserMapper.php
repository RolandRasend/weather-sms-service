<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Attribute\LogChannel;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

final readonly class UserMapper
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        #[LogChannel('UserMapper')] private LoggerInterface $logger
    ) {
    }

    public function save(User $user): bool|string
    {
        try {
            $existingUser = $this->entityManager->createQueryBuilder()
                ->select('User')
                ->from(User::class, 'User')
                ->where('LOWER(User.username) = LOWER(:username)')
                ->setParameter('username', $user->getUsername())
                ->getQuery()
                ->getOneOrNullResult();

            if ($existingUser !== null) {
                return 'A user with this name already exists';
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return true;
        } catch (Exception $e) {
            $this->logger->error(
                'Error while saving user',
                [
                    'file'      => $e->getFile(),
                    'code'      => $e->getCode(),
                    'message'   => $e->getMessage(),
                    'trace'     => $e->getTraceAsString(),
                ],
            );

            return false;
        }
    }

    public function checkLogin(string $username, string $password): bool
    {
        try {
            /**
             * @var User|null $user
             */
            $user = $this->entityManager->createQueryBuilder()
                ->select('User')
                ->from(User::class, 'User')
                ->where('LOWER(User.username) = LOWER(:username)')
                ->setParameter('username', $username)
                ->getQuery()
                ->getOneOrNullResult();
            if (!empty($user)){
                return password_verify($password, $user->getPasswordHash());
            }

            return false;
        } catch (Exception $e) {
            $this->logger->error(
                'Error while logging in user for name ' . $username,
                [
                    'file'      => $e->getFile(),
                    'code'      => $e->getCode(),
                    'message'   => $e->getMessage(),
                    'trace'     => $e->getTraceAsString(),
                ],
            );

            return false;
        }
    }
}
