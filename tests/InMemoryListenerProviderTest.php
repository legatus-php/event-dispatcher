<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support\EventDispatcher\Tests;

use Legatus\Support\EventDispatcher\InMemoryListenerProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class InMemoryListenerProviderTest.
 */
class InMemoryListenerProviderTest extends TestCase
{
    public function testItExtractsSpecificListeners(): void
    {
        $listenerOne = static function (object $event) {};
        $listenerTwo = static function (object $event) {};

        $provider = new InMemoryListenerProvider();
        $provider->register(UserTestEvent::class, $listenerOne);
        $provider->register(UserLoggedIn::class, $listenerTwo);

        $event = new UserLoggedIn('2', new \DateTimeImmutable('2020-01-01'));
        $iterable = $provider->getListenersForEvent($event);

        $this->assertSame($listenerTwo, $iterable->current());
        $iterable->next();
        $this->assertSame($listenerOne, $iterable->current());
    }
}
