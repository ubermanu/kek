<?php

namespace Kek\Cache;

class Memory implements Cache
{
    /**
     * @var array
     */
    protected array $caches = [];

    /**
     * @inheritDoc
     */
    public function load(string $identifier): ?string
    {
        if (array_key_exists($identifier, $this->caches)) {
            $entry = $this->caches[$identifier];
            if (is_null($entry['ttl']) || ($entry['time'] + $entry['ttl'] > \time())) {
                return $entry['data'];
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function save(string $identifier, string $data, ?int $lifeTime = null): bool
    {
        $this->caches[$identifier] = [
            'time' => \time(),
            'data' => $data,
            'ttl' => $lifeTime,
        ];

        return true;
    }

    /**
     * @inheritDoc
     */
    public function remove(string $identifier): bool
    {
        if (array_key_exists($identifier, $this->caches)) {
            unset($this->caches[$identifier]);
        }

        return true;
    }
}
