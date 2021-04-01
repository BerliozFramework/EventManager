<?php

declare(strict_types=1);

namespace Berlioz\EventManager\Event;

/**
 * Class CustomEvent.
 */
class CustomEvent implements EventInterface
{
    protected bool $stopped = false;

    public function __construct(
        protected string $name,
        protected array $data = []
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Stop propagation.
     */
    public function stopPropagation(): void
    {
        $this->stopped = true;
    }

    /**
     * @inheritDoc
     */
    public function isPropagationStopped(): bool
    {
        return $this->stopped;
    }
}