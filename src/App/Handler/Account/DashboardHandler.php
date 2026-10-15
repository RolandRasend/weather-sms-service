<?php

declare(strict_types=1);

namespace App\Handler\Account;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class DashboardHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $dashboardPath = 'public/dashboard.phtml';
        if (file_exists($dashboardPath)) {
            return new HtmlResponse(file_get_contents($dashboardPath));
        }

        return new HtmlResponse('<h1>Dashboard nicht gefunden.</h1>', 404);
    }
}
