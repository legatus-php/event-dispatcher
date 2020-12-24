<?php

declare(strict_types=1);

/*
 * @project Legatus Event Dispatcher
 * @link https://github.com/legatus-php/event-dispatcher
 * @package legatus/event-dispatcher
 * @author Matias Navarro-Carter mnavarrocarter@gmail.com
 * @license MIT
 * @copyright 2021 Matias Navarro-Carter
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ContainerListenerFactoryTest extends TestCase
{
    public function testItCreatesListener(): void
    {
        $eventStub = $this->createStub(DummyEvent::class);
        $containerMock = $this->createMock(ContainerInterface::class);
        $serviceMock = $this->createMock(DummyService::class);

        $containerMock->expects(self::once())
            ->method('get')
            ->with(DummyService::class)
            ->willReturn($serviceMock);

        $serviceMock->expects(self::once())
            ->method('handle')
            ->with($eventStub);

        $factory = new ContainerListenerFactory($containerMock);

        $listener = $factory->create(DummyService::class, 'handle');
        $listener($eventStub);
    }
}

interface DummyEvent
{
}

interface DummyService
{
    public function handle(DummyEvent $event);
}
