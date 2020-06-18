<?php
declare(strict_types=1);

use Legatus\Support\EventDispatcher\EventDispatcher;
use Legatus\Support\EventDispatcher\InMemoryListenerProvider;

require_once __DIR__ . '/../vendor/autoload.php';

$provider = new InMemoryListenerProvider();
$dispatcher = new EventDispatcher($provider);

$provider->register(SomeEvent::class, new SomeListener());
$dispatcher->dispatch(new SomeEvent());