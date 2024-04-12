<?php

use App\Entities\Users;
use Joferreira\DataMapperOrm\Drivers\MySQL as Driver;
// use Joferreira\DataMapperOrm\QueryBuilder\Select;

use Joferreira\DataMapperOrm\Repositories\Repository;

require __DIR__.'/vendor/autoload.php';

// $select = new Select('users', array());

$conn = new Driver;

$conn->connect([
    'server' => 'localhost',
    'database' => 'curso_php_data_mapper',
    'user' => 'root'
]);

// $conn->setQueryBuilder($select);
// $conn->execute();
// $users = $conn->all();

// var_dump($users[0]['name']);
// $user = new Users([
//     'name' => 'João',
//     'email' => 'j@j.com',
//     'password' => '654321'
// ]);
$repository = new Repository($conn);
$repository->setEntity(Users::class);
// $users = $repository->insert($user);
// $user = $repository->first(2);
// $user = $repository->delete($user);
$user = $repository->first(1);
$user->name = 'Josemar Ferreira';
$user = $repository->update($user);

// $users = $repository->first(1);
// $users = $repository->all([
//     ['id', 1]
// ]);
var_dump($user);