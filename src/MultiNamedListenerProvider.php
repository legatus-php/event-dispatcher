<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support\EventDispatcher;

use Generator;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Class MultiNamedListenerProvider.
 *
 * This listener provider takes the class name of an event and its parent
 * classes and interfaces to find listeners for it.
 *
 * This is so you can subscribe to events of a broader type.
 */
abstract class MultiNamedListenerProvider implements ListenerProviderInterface
{
    /**
     * @param object $event
     *
     * @return Generator
     */
    public function getListenersForEvent(object $event): Generator
    {
        $names = $this->extractEventNames($event);
        yield from $this->findListenersForNames(...$names);
    }

    /**
     * @param string ...$names
     *
     * @return iterable
     */
    abstract protected function findListenersForNames(string ...$names): iterable;

    /**
     * @param object $event
     *
     * @return array
     */
    protected function extractEventNames(object $event): array
    {
        return array_merge(
            [get_class($event)],
            array_values(class_parents($event)),
            array_values(class_implements($event))
        );
    }
}
