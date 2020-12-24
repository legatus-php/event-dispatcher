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

use Psr\Container\ContainerInterface;

/**
 * Class ContainerListenerFactory.
 */
class ContainerListenerFactory implements ListenerFactory
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * ContainerListenerFactory constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $class
     * @param string $method
     *
     * @return callable
     */
    public function create(string $class, string $method): callable
    {
        return fn (object $event) => $this->container->get($class)->{$method}($event);
    }
}
