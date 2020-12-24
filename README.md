Legatus Event Dispatcher
========================

A simple PSR-14 implementation

[![Type Coverage](https://shepherd.dev/github/legatus-php/event-dispatcher/coverage.svg)](https://shepherd.dev/github/legatus-php/event-dispatcher)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Flegatus-php%2Fevent-dispatcher%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/legatus-php/event-dispatcher/master)

## Installation
You can install the Event Dispatcher component using [Composer][composer]:

```bash
composer require legatus/event-dispatcher
```

## Quick Start

```php
<?php

$provider = new Legatus\Support\InMemoryListeners();
$dispatcher = new Legatus\Support\EventDispatcher($provider);

$provider->register(SomeEvent::class, new SomeListener());
$dispatcher->dispatch(new SomeEvent());
```

For more details you can check the [online documentation here][docs].

## Project status & release process

While this library is still under development, it is well tested and should be stable enough to use in production environments.

The current releases are numbered 0.x.y. When a non-breaking change is introduced (adding new methods, optimizing existing code, etc.), y is incremented.

When a breaking change is introduced, a new 0.x version cycle is always started.

It is therefore safe to lock your project to a given release cycle, such as 0.2.*.

If you need to upgrade to a newer release cycle, check the [release history][releases] for a list of changes introduced by each further 0.x.0 version.


## Community
We still do not have a community channel. If you would like to help with that, you can let me know!

## Contributing
Read the contributing guide to know how can you contribute to Legatus.

## Security Issues
Please report security issues privately by email and give us a period of grace before disclosing.

## About Legatus
Legatus is a personal open source project led by Matías Navarro Carter and developed by contributors.

[composer]: https://getcomposer.org/
[docs]: https://legatus.dev/components/event-dispatcher
[releases]: https://github.com/legatus-php/event-dispatcher/releases