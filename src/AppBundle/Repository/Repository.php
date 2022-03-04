<?php

namespace AppBundle\Repository;

abstract class Repository
{
    public $conn;
    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'pfev1',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        $this->conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);;
    }

    abstract public function add($object);
    abstract public function edit($id, $object);
    abstract public function findbyId($id);
    abstract public function delete($id);
    abstract public function find();
}
