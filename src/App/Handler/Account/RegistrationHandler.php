<?php

declare(strict_types=1);

namespace App\Handler\Account;

use App\Entity\User;
use App\Helper\PasswordStrength;
use App\Mapper\UserMapper;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class RegistrationHandler implements RequestHandlerInterface
{
    public function __construct(
        private PasswordStrength $passwordStrength,
        private UserMapper $userMapper
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        if (!isset($body['username'])) {
            return new JsonResponse(['error' => 'Missing username'], 400);
        }
        $password = $body['password'] ?? '';
        $strength = $this->passwordStrength->checkStrength($password);
        $rejectionReasons = $this->passwordStrength->generateReasonMessage($strength);
        if (!empty($rejectionReasons)) {
            return new JsonResponse(['error' => $rejectionReasons], 400);
        }

        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $user = new User();
        $user->setUsername($body['username'])->setPasswordHash($hash);

        $result = $this->userMapper->save($user);
        if ($result === false) {
            return new JsonResponse(['error' => 'An error occurred trying to save your data. Try again.'], 500);
        } elseif (is_string($result)) {
            return new JsonResponse(['error' => $result], 400);
        } else {
            return new RedirectResponse('/dashboard');
        }

    }
}
