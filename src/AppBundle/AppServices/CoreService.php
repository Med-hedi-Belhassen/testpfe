<?php
namespace AppBundle\AppServices;

use Doctrine\DBAL\DriverManager;

abstract class CoreService  
{
    public $conn;
    public function __construct() {
        $connectionParams = [
            'dbname' => 'pfev1',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        $this->$conn=\Doctrine\DBAL\DriverManager::getConnection($connectionParams);;
     }

     abstract public function Add($object);
     abstract public function Modify($id);
     abstract public function GetById($id);
     abstract public function Delete($id);
     abstract public function GetAll();

}
