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

/**
 * Class InMemoryListeners.
 */
final class InMemoryListeners extends MultiNamedListenerProvider
{
    /**
     * @var array<class-string,list<callable>>
     */
    private array $listeners;

    /**
     * InMemoryListenerProvider constructor.
     */
    public function __construct()
    {
        $this->listeners = [];
    }

    /**
     * @param string ...$names
     *
     * @return array
     */
    protected function findListenersForNames(string ...$names): array
    {
        return array_merge(
            ...array_map(
                fn (string $name) => $this->listeners[$name] ?? [],
                $names
            )
        );
    }

    /**
     * @param string $name
     * @psalm-param class-string $name
     *
     * @param callable $listener
     */
    public function register(string $name, callable $listener): void
    {
        if (!isset($this->listeners[$name])) {
            $this->listeners[$name] = [];
        }
        $this->listeners[$name][] = $listener;
    }
}
