<?php

namespace Kek\Entity;

use Kek\Traits\DataObject;

abstract class Model
{
    use DataObject;

    /**
     * @var string
     */
    protected string $table;

    /**
     * @var string
     */
    protected string $primaryKey = 'id';

    /**
     * @var Repository
     */
    protected Repository $repository;

    /**
     * @var array
     */
    public function __construct(array $data = [])
    {
        $this->setData($data);
        $this->__initialize();
    }

    /**
     * @return void
     */
    protected function __initialize()
    {
        $this->repository = new Repository(null, $this, $this->table, $this->primaryKey);
    }

    /**
     * @return bool
     * @throws CouldNotSaveException
     */
    public function save(): bool
    {
        return $this->repository->save($this);
    }

    /**
     * @return bool
     * @throws CannotDeleteException
     */
    public function delete(): bool
    {
        return $this->repository->delete($this);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->getData();
    }
}
