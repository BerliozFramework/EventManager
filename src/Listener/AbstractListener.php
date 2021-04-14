<?php
/*
 * This file is part of Berlioz framework.
 *
 * @license   https://opensource.org/licenses/MIT MIT License
 * @copyright 2021 Ronan GIRON
 * @author    Ronan GIRON <https://github.com/ElGigi>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code, to the root.
 */

declare(strict_types=1);

namespace Berlioz\EventManager\Listener;

use Berlioz\EventManager\Event\EventInterface;
use Closure;
use InvalidArgumentException;

/**
 * Class AbstractListener.
 */
abstract class AbstractListener implements ListenerInterface
{
    public function __construct(
        protected string $event,
        protected Closure|string $callback,
        protected int $priority = ListenerInterface::PRIORITY_NORMAL
    ) {
    }

    /**
     * Get priority.
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Is listening event?
     *
     * @param object|string $event
     *
     * @return bool
     */
    public function isListening(object|string $event): bool
    {
        if ($event instanceof EventInterface) {
            return $event->getName() === $this->event;
        }

        if (is_string($event) && $this->event === $event) {
            return true;
        }

        return $event instanceof $this->event;
    }
}