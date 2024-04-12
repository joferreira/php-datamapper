<?php

namespace Joferreira\DataMapperOrm\Drivers;

use Joferreira\DataMapperOrm\QueryBuilder\QueryBuilderInterface;

interface DriverInterface
{
    public function connect(array $config);
    public function close();
    public function setQueryBuilder(QueryBuilderInterface $query);
    public function execute();
    public function lastInsertedId();
    public function first();
    public function all();
}
