<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support;

use Generator;

/**
 * Class InMemoryListenerProvider.
 */
final class InMemoryListenerProvider extends MultiNamedListenerProvider
{
    protected array $listeners;

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
     * @return Generator
     */
    protected function findListenersForNames(string ...$names): Generator
    {
        foreach ($names as $name) {
            foreach ($this->listeners as $type => $listeners) {
                if ($name === $type) {
                    yield from $listeners;
                }
            }
        }
    }

    /**
     * @param string   $name
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
