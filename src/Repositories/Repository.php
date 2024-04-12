<?php

namespace Joferreira\DataMapperOrm\Repositories;

use Joferreira\DataMapperOrm\Drivers\DriverInterface;
use Joferreira\DataMapperOrm\Entities\Entity;
use Joferreira\DataMapperOrm\Entities\EntityInterface;
use Joferreira\DataMapperOrm\QueryBuilder\Delete;
use Joferreira\DataMapperOrm\QueryBuilder\Insert;
use Joferreira\DataMapperOrm\QueryBuilder\Select; 
// use App\Entities\Users as Entity;

class Repository
{
    protected $driver;
    protected $entity;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function setEntity(string $entity)
    {
        $reflection = new \ReflectionClass($entity);

        if ($reflection->implementsInterface(EntityInterface::class) == false) {
            throw new \InvalidArgumentException("{$entity} not implements interface ". EntityInterface::class);
        }

        $this->entity = $entity;
    }

    public function getEntity(): EntityInterface
    {
        if (is_null($this->entity)) {
            throw new \Exception('entity is required');
        }

        if (is_string($this->entity)) {
            return new $this->entity;
        }
    }

    public function insert(EntityInterface $entity): EntityInterface
    {
        $table =  $entity->getTable();
        $this->driver->setQueryBuilder(new Insert($table, $entity->getAll()));
        $this->driver->execute();

        return $this->first($this->driver->lastInsertedId());
    }

    public function update(EntityInterface $entity): EntityInterface
    {
        $table = $entity->getTable();
        $conditions = [
            'id', $entity->id
        ];

        $this->driver->setQueryBuilder(new Update($table, $entity->getAll(), $conditions));
        $this->driver->execute();

        return new Entity;
    }

    public function delete(EntityInterface $entity): EntityInterface
    {
        $table = $entity->getTable();
        $conditions = [
            ['id', $entity->getAll()['id']]
        ];
        $this->driver->setQueryBuilder(new Delete($table, $conditions));
        $this->driver->execute();

        return $entity;
    }

    public function first($id = null): ?EntityInterface
    {
        $entity = $this->getEntity();
        $table = $entity->getTable();
        $conditions = [];
        if (is_null($id) == false) {
            $conditions[] = ['id', $id];
        }
        $this->driver->setQueryBuilder(new Select($table,$conditions));
        $this->driver->execute();
        $data = $this->driver->first();
        if (!$data) {
            return null;
        }
        return $entity->setAll($data);
    }

    public function all(array $conditions = []): array
    {
        $entity = $this->getEntity();
        $table = $entity->getTable();
        $this->driver->setQueryBuilder(new Select($table,$conditions));
        $this->driver->execute();
        $data =  $this->driver->all();

        $entities = [];
        foreach ($data as $row) {
            $entities[] = new $this->entity($row);
        }
        return $entities;
    }
}
