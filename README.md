# Berlioz Event Manager

[![Latest Version](https://img.shields.io/packagist/v/berlioz/event-manager.svg?style=flat-square)](https://github.com/BerliozFramework/EventManager/releases)
[![Software license](https://img.shields.io/github/license/BerliozFramework/EventManager.svg?style=flat-square)](https://github.com/BerliozFramework/EventManager/blob/1.x/LICENSE)
[![Build Status](https://img.shields.io/github/actions/workflow/status/BerliozFramework/EventManager/Tests/tests.yml?branch=1.x&style=flat-square)](https://github.com/BerliozFramework/EventManager/actions/workflows/tests.yml?query=branch%3A1.x)
[![Quality Grade](https://img.shields.io/codacy/grade/6d8e0d591a914e208876c48c02be2565/1.x.svg?style=flat-square)](https://www.codacy.com/manual/BerliozFramework/EventManager)
[![Total Downloads](https://img.shields.io/packagist/dt/berlioz/event-manager.svg?style=flat-square)](https://packagist.org/packages/berlioz/event-manager)

**Berlioz Event Manager** is a PHP event manager/dispatcher, respecting PSR-14 (Event Dispatcher) standard.

For more information, and use of Berlioz Framework, go to website and online documentation :
https://getberlioz.com

## Installation

### Composer

You can install **Berlioz Event Manager** with [Composer](https://getcomposer.org/), it's the recommended installation.

```bash
$ composer require berlioz/event-manager
```

### Dependencies

* **PHP** ^8.0
* Packages:
    * **psr/event-dispatcher**

## Usage

### Dispatcher

To initialize the event dispatcher:

```php
use Berlioz\EventManager\EventDispatcher;

$dispatcher = new EventDispatcher();
```

To listen an event:

```php
use Berlioz\EventManager\EventDispatcher;

$callback = function($event) {
    // Do something
    return $event;
};

/** @var EventDispatcher $dispatcher */

// A named event
$dispatcher->addEventListener('event.name', $callback);

// Your event object
$dispatcher->addEventListener(MyEvent::class, $callback);
```

To dispatch an event:

```php
/** @var EventDispatcher $dispatcher */
use Berlioz\EventManager\Event\CustomEvent;
use Berlioz\EventManager\EventDispatcher;

// A named event
$dispatcher->dispatch(new CustomEvent('event.name'));

// Your event object
$dispatcher->dispatch(new MyEvent());
```

### Priority

You can define a priority in your listeners. The highest priority is in the first executions.

```php
use Berlioz\EventManager\Listener\ListenerInterface;

/** ... */

// Normal priority (0)
$dispatcher->addEventListener('event.name', $callback, ListenerInterface::PRIORITY_NORMAL);
// High priority (100)
$dispatcher->addEventListener('event.name', $callback, ListenerInterface::PRIORITY_HIGH);
// Low priority (-100)
$dispatcher->addEventListener('event.name', $callback, ListenerInterface::PRIORITY_LOW);
```

The priority argument is an integer ; you can so define your priority with integer value instead of constant.

### Add delegate dispatcher

You can delegate dispatch to another dispatcher who respects PSR-14. The delegated dispatchers are called after, only if
event isn't stopped.

```php
use Berlioz\EventManager\EventDispatcher;

$dispatcher = new EventDispatcher();
$dispatcher->addEventDispatcher(new MyCustomDispatcher());
```

### Add listener provider

You can add listener providers. Providers are called in the order of addition.

```php
use Berlioz\EventManager\EventDispatcher;

$dispatcher = new EventDispatcher();
$dispatcher->addListenerProvider(new MyListenerProvider());
```

### Default listener

The default listener is `\Berlioz\EventManager\Listener\Listener`. You can define your own default provider, he must
implement `\Berlioz\EventManager\Listener\ListenerInterface` interface.

To declare this into the dispatcher:

```php
use Berlioz\EventManager\EventDispatcher;
use Berlioz\EventManager\Provider\ListenerProvider;$myDefaultProvider = new ListenerProvider();

$dispatcher = new EventDispatcher(defaultProvider: $myDefaultProvider);
```