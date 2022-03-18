<?php

namespace Kek\Database;

interface Database
{
    /**
     * @return $this
     */
    public function connect(): Database;

    /**
     * @return $this
     */
    public function disconnect(): Database;

    /**
     * @param string $sql
     * @return mixed
     */
    public function query(string $sql): mixed;

    /**
     * @return false|int
     */
    public function lastInsertId(): mixed;
}
