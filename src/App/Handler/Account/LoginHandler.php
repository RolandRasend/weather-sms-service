<?php

declare(strict_types=1);

namespace App\Handler\Account;

use App\Helper\PasswordStrength;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class LoginHandler implements RequestHandlerInterface
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

        //TODO: verify with data from DB

        return new EmptyResponse();
    }
}
