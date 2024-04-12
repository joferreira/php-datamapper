<?php

namespace Joferreira\DataMapperOrm\Drivers;

use Joferreira\DataMapperOrm\QueryBuilder\QueryBuilderInterface;


class MySQL implements DriverInterface
{

    protected $dsn_pattern = 'mysql:host=%s;dbname=%s';

    use PDOTrait;
}
