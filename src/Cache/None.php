<?php

namespace Kek\Cache;

class None implements Cache
{
    /**
     * @inheritDoc
     */
    public function load(string $identifier): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function save(string $identifier, string $data, ?int $lifeTime = null): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function remove(string $identifier): bool
    {
        return true;
    }
}
