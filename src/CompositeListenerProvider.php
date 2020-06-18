<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support\EventDispatcher;

use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Class CompositeListenerProvider.
 */
final class CompositeListenerProvider implements ListenerProviderInterface
{
    /**
     * @var ListenerProviderInterface[]
     */
    private array $providers;

    /**
     * CompositeListenerProvider constructor.
     *
     * @param ListenerProviderInterface ...$providers
     */
    public function __construct(ListenerProviderInterface ...$providers)
    {
        $this->providers = $providers;
    }

    /**
     * @param object $event
     *
     * @return iterable
     */
    public function getListenersForEvent(object $event): iterable
    {
        $iterator = new CompositeIterator();
        foreach ($this->providers as $provider) {
            $iterator->addIterable($provider->getListenersForEvent($event));
        }

        return $iterator;
    }
}
