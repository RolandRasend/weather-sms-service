<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\HomePageHandler;
use App\Handler\PingHandler;
use App\Handler\Account\RegisterHandler;
use Mezzio\Router\RouterInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class AutoWireIntegrationTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $this->container = require __DIR__ . '/../../../config/container.php';
    }

    public function testCanCreateHomePageHandler(): void
    {
        $this->assertTrue($this->container->has(HomePageHandler::class));
        $handler = $this->container->get(HomePageHandler::class);
        $this->assertInstanceOf(HomePageHandler::class, $handler);
    }

    public function testCanCreatePingHandler(): void
    {
        $this->assertTrue($this->container->has(PingHandler::class));
        $handler = $this->container->get(PingHandler::class);
        $this->assertInstanceOf(PingHandler::class, $handler);
    }

    public function testCanCreateRegisterHandler(): void
    {
        $this->assertTrue($this->container->has(RegisterHandler::class));
        $handler = $this->container->get(RegisterHandler::class);
        $this->assertInstanceOf(RegisterHandler::class, $handler);
    }
}
