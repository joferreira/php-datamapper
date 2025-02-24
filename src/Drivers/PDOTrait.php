<?php

namespace Joferreira\DataMapperOrm\Drivers;

use Joferreira\DataMapperOrm\QueryBuilder\QueryBuilderInterface;

trait PDOTrait
{

    protected $pdo;
    protected $query;
    // private $sth;
    
    public function connect(array $config)
    {   

        if (empty($config['server']) == true) {
            throw new \InvalidArgumentException('server is required');
        }

        if (empty($config['database']) == true) {
            throw new \InvalidArgumentException('database is required');
        }

        if (empty($config['user']) == true) {
            throw new \InvalidArgumentException('user is required');
        }

        $dsn = sprintf($this->dsn_pattern, $config['server'], $config['database']);
        $user = $config['user'];
        $password = $config['password'] ?? null;
        $options = $config['options'] ?? [];
        $this->pdo = new \PDO($dsn, $user, $password, $options);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function close()
    {
        $this->pdo = null;
    }
    public function setQueryBuilder(QueryBuilderInterface $query)
    {
        $this->query = $query;
    }
    public function execute()
    {
        $this->sth = $this->pdo->prepare((string)$this->query);
        $result = $this->sth->execute($this->query->getValues());
        return $result;
    }
    public function lastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }
    public function first()
    {
        return $this->pdo->fetch(\PDO::FETCH_ASSOC);
    }
    public function all()
    {
        return $this->pdo->fetchAll(\PDO::FETCH_ASSOC);
    }
}
