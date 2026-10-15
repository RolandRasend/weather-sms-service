<?php

declare(strict_types=1);

namespace App\Resolver;

use BluePsyduck\LaminasAutoWireFactory\Resolver\ResolverInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final readonly class LogChannelResolver implements ResolverInterface
{
    public function __construct(
        private string $name
    ) {
    }

    public function resolve(ContainerInterface $container): LoggerInterface
    {
        $logger = new Logger($this->name);
        $logger->pushHandler(new StreamHandler('data/log/app.log'));

        return $logger;
    }

    public function canResolve(ContainerInterface $container): bool
    {
        return true;
    }
}
