<?php

declare(strict_types=1);

/*
 * This file is part of the Legatus project organization.
 * (c) Matías Navarro-Carter <contact@mnavarro.dev>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../vendor/autoload.php';

$provider = new Legatus\Support\InMemoryListenerProvider();
$dispatcher = new Legatus\Support\EventDispatcher($provider);

$provider->register(SomeEvent::class, new SomeListener());
$dispatcher->dispatch(new SomeEvent());
