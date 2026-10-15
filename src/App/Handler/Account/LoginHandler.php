<?php

declare(strict_types=1);

namespace App\Handler\Account;

use App\Mapper\UserMapper;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class LoginHandler implements RequestHandlerInterface
{
    public function __construct(
        private UserMapper $userMapper
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        if (!isset($body['username'])) {
            return new JsonResponse(['error' => 'Missing username'], 400);
        }
        $loginAllowed = $this->userMapper->checkLogin($body['username'], $body['password'] ?? '');

        if ($loginAllowed === false) {
            return new JsonResponse(['error' => 'Username or password do not match'], 400);
        } else {
            return new RedirectResponse('/dashboard');
        }
    }
}
