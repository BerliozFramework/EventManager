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

namespace Berlioz\EventManager\Tests\Listener;

use Berlioz\EventManager\Event\CustomEvent;
use Berlioz\EventManager\Listener\Listener;
use Berlioz\EventManager\Listener\ListenerInterface;
use Berlioz\EventManager\Tests\Event\TestEvent;
use PHPUnit\Framework\TestCase;
use stdClass;

class ListenerTest extends TestCase
{
    public function testGetPriority_default()
    {
        $listener = new Listener(stdClass::class, fn($event) => true);

        $this->assertEquals(ListenerInterface::PRIORITY_NORMAL, $listener->getPriority());
    }

    public function testGetPriority()
    {
        $listener = new Listener(stdClass::class, fn($event) => true, 8);

        $this->assertEquals(8, $listener->getPriority());
    }

    public function testIsListening()
    {
        $listener = new Listener(stdClass::class, fn($event) => true, 8);

        $this->assertFalse($listener->isListening(new CustomEvent('test')));
        $this->assertTrue($listener->isListening(new stdClass()));
    }

    public function testIsListeningCustomEvent()
    {
        $listener = new Listener('event.test', fn($event) => true, 8);

        $this->assertTrue($listener->isListening(new CustomEvent('event.test')));
        $this->assertTrue($listener->isListening('event.test'));
        $this->assertFalse($listener->isListening(new CustomEvent('test.event')));
        $this->assertFalse($listener->isListening(new stdClass()));
    }

    public function testInvoke()
    {
        $listener = new Listener(TestEvent::class, fn(TestEvent $event) => $event->increaseCounter());
        $event = new TestEvent('event.name');

        $this->assertEquals(0, $event->getCounter());

        $listener->invoke($event);
        $this->assertEquals(1, $event->getCounter());

        $listener->invoke($event);
        $this->assertEquals(2, $event->getCounter());
    }
}
