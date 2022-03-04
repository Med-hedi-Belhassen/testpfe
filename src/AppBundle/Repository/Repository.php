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

    public function getParams($object)
    {
        $param = (array) $object;
        var_dump($param);
        $keys = array();
        $values = array();
        array_shift($param);
        foreach ($param as $key => $value) {
            $x = explode($key[0], $key);
            $key = $x[2];
            array_push($keys, $key);
            array_push($values, $value);
        }
        $fparam = array_combine($keys, $values);

        return $fparam;
    }

    public function hydrator($classname, $data, $x)
    {
        if ($x == 1) {
            $obj = new $classname();
            foreach ($data as $dt) {
                foreach ($dt as $key => $value) {
                    $obj->$key = $value;
                    //var_dump($key);
                }
            }
            return $obj;
        } else {
            $res = array();
            foreach ($data as $dt) {
                $obj = new $classname();
                foreach ($dt as $key => $value) {
                    $obj->$key = $value;
                    //var_dump($key);
                }
                array_push($res, $obj);
            }
            return $res;
        }
        //var_dump($obj);


    }
}
