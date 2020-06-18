<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support\EventDispatcher;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

/**
 * Class ContainerListenerProvider.
 *
 * This listener provider allows to fetch listeners from a dependency
 * injection container.
 *
 * It makes the big assumption that the container is capable of returning
 * iterables or arrays from some service definitions, like tags.
 *
 * Tags need to be named after the class, parents or interfaces in order to
 * work.
 *
 * If your container does not support fetching tags as arrays or iterables
 * you'll have to roll your own listener provider or use the in memory one.
 */
final class ContainerListenerProvider extends MultiNamedListenerProvider
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * ContainerListenerProvider constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string ...$names
     *
     * @return iterable
     *
     * @throws Throwable
     */
    protected function findListenersForNames(string ...$names): iterable
    {
        foreach ($names as $name) {
            yield from $this->findServiceInContainer($name);
        }
    }

    /**
     * @param string $name
     *
     * @return iterable
     *
     * @throws Throwable
     */
    protected function findServiceInContainer(string $name): iterable
    {
        try {
            $services = $this->container->get($name);
        } catch (Throwable $e) {
            if ($e instanceof NotFoundExceptionInterface) {
                return [];
            }
            throw $e;
        }

        if (!is_array($services)) {
            $services = [$services];
        }

        return $services;
    }
}
