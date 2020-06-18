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
 * Class UserTestEvent.
 */
abstract class UserTestEvent implements EventTestInterface
{
    private string $userId;

    /**
     * UserTestEvent constructor.
     *
     * @param string $userId
     */
    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return '1';
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return DateTimeInterface
     */
    public function getOccurredOn(): DateTimeInterface
    {
        return new \DateTimeImmutable('1988-05-04');
    }
}
