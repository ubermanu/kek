<?php

namespace Kek\Entity;

use Kek\Database\Current as CurrentDatabase;
use Kek\Database\Database;

class Repository
{
    /**
     * @var Database
     */
    protected Database $db;

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var string
     */
    protected string $table;

    /**
     * @var string
     */
    protected string $primaryKey;

    /**
     * @param Database|null $db
     * @param Model $model
     * @param string $table
     * @param string $primaryKey
     */
    public function __construct(?Database $db, Model $model, string $table, string $primaryKey)
    {
        $this->db = $db;
        $this->model = $model;
        $this->table = $table;
        $this->primaryKey = $primaryKey;

        try {
            $this->db ??= CurrentDatabase::instance()->get();
        } catch (\Throwable $e) {
        }
    }

    /**
     * @param int $id
     * @return Model
     * @throws NoSuchEntityException
     */
    public function get(int $id): Model
    {
        $query = $this->db->query("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $query->bindValue(':id', $id);
        $query->execute();

        $result = $query->fetch();

        if ($result === false) {
            throw new NoSuchEntityException();
        }

        return $this->model->setData($result);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $query = $this->db->query("SELECT * FROM {$this->table}");
        $query->execute();

        $items = [];
        $result = $query->fetchAll();

        foreach ($result as $row) {
            $items[] = clone $this->model->setData($row);
        }

        return $items;
    }

    /**
     * @param Model $entity
     * @return bool
     * @throws CouldNotSaveException
     */
    public function save(Model $entity): bool
    {
        $columns = array_keys($entity->getData());
        $values = array_values($entity->getData());

        $query = $this->db->prepare(
            "INSERT INTO {$this->table} (" . implode(', ', $columns) . ") " .
            "VALUES (" . implode(', ', array_fill(0, count($columns), '?')) . ")"
        );

        if (!$query->execute($values)) {
            throw new CouldNotSaveException();
        }

        return true;
    }

    /**
     * @param Model $entity
     * @return bool
     * @throws CannotDeleteException
     */
    public function delete(Model $entity): bool
    {
        return $this->deleteById($entity->getId());
    }

    /**
     * @param int $id
     * @return bool
     * @throws CannotDeleteException
     */
    public function deleteById(int $id): bool
    {
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $query->bindValue(':id', $id);

        if (!$query->execute()) {
            throw new CannotDeleteException();
        }

        return true;
    }
}
