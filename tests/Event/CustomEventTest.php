<?php

namespace Berlioz\EventManager\Tests\Event;

use Berlioz\EventManager\Event\CustomEvent;
use PHPUnit\Framework\TestCase;

class CustomEventTest extends TestCase
{
    public function testGetName()
    {
        $event = new CustomEvent('event.name');

        $this->assertEquals('event.name', $event->getName());
    }

    public function testGetData_default()
    {
        $event = new CustomEvent('event.name');

        $this->assertEquals([], $event->getData());
    }

    public function testGetData()
    {
        $event = new CustomEvent('event.name', $data = ['foo' => 'bar', 'baz' => ['qux', 'quux']]);

        $this->assertEquals($data, $event->getData());
    }

    public function testStopPropagation()
    {
        $event = new CustomEvent('event.name');

        $this->assertFalse($event->isPropagationStopped());

        $event->stopPropagation();

        $this->assertTrue($event->isPropagationStopped());
    }
}
