<?php

declare(strict_types=1);

namespace Berlioz\EventManager\Tests;

use Berlioz\EventManager\EventDispatcher;

class FakeEventDispatcher extends EventDispatcher
{
    /**
     * @return array
     */
    public function getDispatchers(): array
    {
        return $this->dispatchers;
    }

    /**
     * @return array
     */
    public function getProviders(): array
    {
        return $this->providers;
    }
}