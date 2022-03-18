<?php

namespace Kek\Cache;

interface Cache
{
    /**
     * @param string $identifier
     * @return string|null
     */
    public function load(string $identifier): ?string;

    /**
     * @param string $identifier
     * @param string $data
     * @param int|null $lifeTime
     * @return bool
     */
    public function save(string $identifier, string $data, ?int $lifeTime = null): bool;

    /**
     * @param string $identifier
     * @return bool
     */
    public function remove(string $identifier): bool;
}
