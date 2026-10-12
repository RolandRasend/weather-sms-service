<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly RouterInterface $router,
        private readonly ?TemplateRendererInterface $template = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $loginHtmlPath = 'public/login.html';
        if (file_exists($loginHtmlPath)) {
            return new HtmlResponse(file_get_contents($loginHtmlPath));
        }

        return new HtmlResponse('<h1>SMS Weather Service</h1><p>Login page not found.</p>', 404);
    }
}
