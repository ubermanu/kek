<?php

namespace Kek\Database;

use Kek\Exception;
use Kek\Traits\Singleton;

final class Current
{
    use Singleton;

    /**
     * @var string The current db
     */
    protected static string $code = 'default';

    /**
     * @var Database[]
     */
    protected static array $databases = [];

    /**
     * @param string $code
     * @param Database $database
     * @return $this
     * @throws Exception
     */
    public function add(string $code, Database $database): self
    {
        if (isset(self::$databases[$code])) {
            throw new Exception('Database with code "' . $code . '" already exists');
        }

        self::$databases[$code] = $database;
        return $this;
    }

    /**
     * @param string|null $code
     * @return Database
     * @throws Exception
     */
    public function get(?string $code = null): Database
    {
        if ($code === null) {
            $code = self::$code;
        }

        if (!isset(self::$databases[$code])) {
            throw new Exception('Database with code "' . $code . '" does not exist');
        }

        return self::$databases[$code];
    }

    /**
     * @param string $code
     * @return $this
     * @throws Exception
     */
    public function use(string $code): self
    {
        if (!isset(self::$databases[$code])) {
            throw new Exception('Database with code "' . $code . '" does not exist');
        }

        self::$code = $code;
        return $this;
    }
}
