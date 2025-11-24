<?php

namespace App\Mapping;

abstract class AbstractMapping
{
    /**
     * @var int
     */
    protected int $id;

    public function __construct()
    {
        // Basic constructor for common initialization if needed
    }

    /**
     * Get the ID of the entity.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the ID of the entity.
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
}
