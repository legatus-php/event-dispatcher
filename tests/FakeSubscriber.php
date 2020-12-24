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

use Legatus\Support\Annotation\ListensTo;

class FakeSubscriber
{
    /**
     * @param UserRegistered $event
     * @ListensTo("Legatus\Support\UserRegistered")
     */
    public function sendEmail(UserRegistered $event): void
    {
        $name = $event->getEventName();
    }
}
