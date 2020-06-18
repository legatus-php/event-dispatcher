Legatus Event Dispatcher
========================

A simple PSR-14 implementation

[![Build Status](https://drone.mnavarro.dev/api/badges/legatus/event-dispatcher/status.svg)](https://drone.mnavarro.dev/legatus/event-dispatcher)

## Installation
You can install the Event Dispatcher component using [Composer][composer]:

```bash
composer require legatus/event-dispatcher
```

## Quick Start

```php
<?php

$provider = new InMemoryListenerProvider();
$dispatcher = new EventDispatcher($provider);

$provider->register(SomeEvent::class, new SomeListener());
$dispatcher->dispatch(new SomeEvent());
```

For more details you can check the [online documentation here][docs].

## Community
We still do not have a community channel. If you would like to help with that, you can let me know!

## Contributing
Read the contributing guide to know how can you contribute to Legatus.

## Security Issues
Please report security issues privately by email and give us a period of grace before disclosing.

## About Legatus
Legatus is a personal open source project led by Matías Navarro Carter and developed by contributors.

[composer]: https://getcomposer.org/
[docs]: https://legatus.mnavarro.dev/components/event-dispatcher