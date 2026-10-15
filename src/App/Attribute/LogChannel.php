<?php

declare(strict_types=1);

namespace App\Attribute;

use App\Resolver\LogChannelResolver;
use Attribute;
use BluePsyduck\LaminasAutoWireFactory\Attribute\ResolverAttribute;
use BluePsyduck\LaminasAutoWireFactory\Resolver\ResolverInterface;

#[Attribute(Attribute::TARGET_PARAMETER)]
final readonly class LogChannel implements ResolverAttribute
{
    public function __construct(
        private string $name
    ) {
    }

    public function createResolver(): ResolverInterface
    {
        return new LogChannelResolver($this->name);
    }
}
