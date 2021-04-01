<?php

declare(strict_types=1);

namespace Berlioz\EventManager\Provider;

use Berlioz\EventManager\Listener\ListenerInterface;
use Psr\EventDispatcher\ListenerProviderInterface as PsrListenerProviderInterface;

/**
 * Interface ListenerProviderInterface.
 */
interface ListenerProviderInterface extends PsrListenerProviderInterface
{
    /**
     * Add event listener.
     *
     * @param string|object $event
     * @param callable $callback
     * @param int $priority
     *
     * @return ListenerInterface
     */
    public function addEventListener(string|object $event, callable $callback, int $priority = 0): ListenerInterface;

    /**
     * Add listener.
     *
     * @param ListenerInterface ...$listener
     */
    public function addListener(ListenerInterface ...$listener): void;
}