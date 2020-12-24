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

use Doctrine\Common\Annotations\AnnotationReader;
use Psr\EventDispatcher\ListenerProviderInterface;
use ReflectionException;

/**
 * Class AnnotatedSubscribers.
 *
 * This ListenerProvider implementation registers multiple listeners out of an
 * annotated class.
 */
final class AnnotatedSubscribers implements ListenerProviderInterface
{
    private ListenerFactory $listener;
    private AnnotationReader $reader;
    private InMemoryListeners $listeners;

    /**
     * ContainerListenerProvider constructor.
     *
     * @param ListenerFactory   $listener
     * @param AnnotationReader  $reader
     * @param InMemoryListeners $listeners
     */
    public function __construct(ListenerFactory $listener, AnnotationReader $reader, InMemoryListeners $listeners)
    {
        $this->listener = $listener;
        $this->reader = $reader;
        $this->listeners = $listeners;
    }

    /**
     * @param class-string $subscriber
     *
     * @throws ReflectionException
     */
    public function register(string $subscriber): void
    {
        $refClass = new \ReflectionClass($subscriber);
        foreach ($refClass->getMethods() as $method) {
            $listensTo = $this->reader->getMethodAnnotation($method, Annotation\ListensTo::class);
            if ($listensTo instanceof Annotation\ListensTo) {
                $this->listeners->register(
                    $listensTo->event,
                    $this->listener->create($subscriber, $method->getName())
                );
            }
        }
    }

    /**
     * @param string $eventName
     * @psalm-param class-string $eventName
     *
     * @param callable $listener
     */
    protected function add(string $eventName, callable $listener): void
    {
        $this->listeners->register($eventName, $listener);
    }

    public function getListenersForEvent(object $event): iterable
    {
        return $this->listeners->getListenersForEvent($event);
    }
}
