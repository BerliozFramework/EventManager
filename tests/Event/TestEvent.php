<?php

namespace Berlioz\EventManager\Tests\Event;

use Berlioz\EventManager\Event\CustomEvent;

class TestEvent extends CustomEvent
{
    protected int $counter = 0;

    public function getCounter(): int
    {
        return $this->counter;
    }

    public function increaseCounter(): static
    {
        $this->counter++;

        return $this;
    }
}