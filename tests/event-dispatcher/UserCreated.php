<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support;

/**
 * Class UserCreated.
 */
class UserCreated extends UserTestEvent
{
    private string $username;

    /**
     * UserCreated constructor.
     *
     * @param string $userId
     * @param string $username
     */
    public function __construct(string $userId, string $username)
    {
        parent::__construct($userId);
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}
