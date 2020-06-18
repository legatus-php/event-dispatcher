<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support\EventDispatcher\Tests;

use DateTimeInterface;

/**
 * Interface EventTestInterface.
 */
interface EventTestInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return DateTimeInterface
     */
    public function getOccurredOn(): DateTimeInterface;
}
