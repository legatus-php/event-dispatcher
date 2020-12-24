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
     * @psalm-param class-string ...$names
     *
     * @return array
     */
    abstract protected function findListenersForNames(string ...$names): array;

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
