<?php

namespace Kek\Database;

class Relational implements Database
{
    /**
     * @var \PDO|null
     */
    protected ?\PDO $connection;

    /**
     * @param string $dsn
     */
    public function __construct(string $dsn)
    {
        $this->connection = new \PDO($dsn);
    }

    /**
     * @return $this
     */
    public function connect(): Relational
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function disconnect(): Relational
    {
        $this->connection = null;
        return $this;
    }

    /**
     * @param string $sql
     * @return \PDOStatement|bool
     */
    public function query(string $sql): \PDOStatement|bool
    {
        return $this->connection->query($sql);
    }

    /**
     * @param string $sql
     * @return \PDOStatement|bool
     */
    public function prepare(string $sql): \PDOStatement|bool
    {
        return $this->connection->prepare($sql);
    }

    /**
     * @return string|bool
     */
    public function lastInsertId(): string|bool
    {
        return $this->connection->lastInsertId();
    }
}
