<?php

namespace Kek\Traits;

trait DataObject
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @param mixed|string $key
     * @param mixed $value
     * @return $this
     */
    public function setData(mixed $key, mixed $value = null): self
    {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);
        } else {
            $this->data[$key] = $value;
        }
        return $this;
    }

    /**
     * @param mixed|string $key
     * @return mixed|array
     */
    public function getData(mixed $key = null): mixed
    {
        if (is_null($key)) {
            return $this->data;
        }
        return $this->data[$key] ?? null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasData(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * @param string $key
     * @return $this
     */
    public function unsetData(string $key): self
    {
        unset($this->data[$key]);
        return $this;
    }
}
