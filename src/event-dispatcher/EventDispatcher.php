<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support;

use Exception;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class EventDispatcher.
 *
 * A very simple PSR-14 event dispatcher implementation.
 */
final class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var ListenerProviderInterface
     */
    private ListenerProviderInterface $provider;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * EventDispatcher constructor.
     *
     * @param ListenerProviderInterface $provider
     * @param LoggerInterface|null      $logger
     */
    public function __construct(ListenerProviderInterface $provider, LoggerInterface $logger = null)
    {
        $this->provider = $provider;
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @param object $event
     *
     * @return object
     *
     * @throws Exception
     */
    public function dispatch(object $event): object
    {
        if ($this->isStopped($event)) {
            return $event;
        }

        foreach ($this->provider->getListenersForEvent($event) as $listener) {
            try {
                $listener($event);
                if ($this->isStopped($event)) {
                    break;
                }
            } catch (Exception $exception) {
                $this->logger->warning('Unhandled exception thrown from listener while processing event.', [
                    'event' => $event,
                    'exception' => $exception,
                ]);
                throw $exception;
            }
        }

        return $event;
    }

    /**
     * @param object $event
     *
     * @return bool
     */
    protected function isStopped(object $event): bool
    {
        return $event instanceof StoppableEventInterface && $event->isPropagationStopped();
    }
}
