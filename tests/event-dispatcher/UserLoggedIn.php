<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Legatus\Support;

use DateTimeInterface;

/**
 * Class UserLoggedIn.
 */
class UserLoggedIn extends UserTestEvent
{
    private DateTimeInterface $loginTime;

    /**
     * UserLoggedIn constructor.
     *
     * @param string            $userId
     * @param DateTimeInterface $loginTime
     */
    public function __construct(string $userId, DateTimeInterface $loginTime)
    {
        parent::__construct($userId);
        $this->loginTime = $loginTime;
    }

    /**
     * @return DateTimeInterface
     */
    public function getLoginTime(): DateTimeInterface
    {
        return $this->loginTime;
    }
}
