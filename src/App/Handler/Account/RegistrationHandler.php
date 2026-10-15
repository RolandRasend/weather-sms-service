<?php

declare(strict_types=1);

namespace App\Handler\Account;

use App\Helper\PasswordStrength;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class RegistrationHandler implements RequestHandlerInterface
{
    public function __construct(
        private PasswordStrength $passwordStrength
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

        //TODO: build user object & Save hash to DB with mapper

        return new EmptyResponse();
    }
}
