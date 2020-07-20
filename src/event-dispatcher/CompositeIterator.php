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
use IteratorAggregate;

/**
 * Class CompositeIterator.
 *
 * This iterator iterates over many iterables
 */
final class CompositeIterator implements IteratorAggregate
{
    /**
     * @var iterable[]
     */
    protected array $iterables;

    /**
     * CompositeIterator constructor.
     */
    public function __construct()
    {
        $this->iterables = [];
    }

    /**
     * @param iterable $iterable
     */
    public function addIterable(iterable $iterable): void
    {
        $this->iterables[] = $iterable;
    }

    /**
     * @return Generator[callable]
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterables as $iterable) {
            foreach ($iterable as $element) {
                yield $element;
            }
        }
    }
}
