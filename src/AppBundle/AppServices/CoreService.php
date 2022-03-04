<?php

namespace AppBundle\AppServices;



abstract class CoreService
{
    abstract public function Add($object);
    abstract public function Modify($id, $object);
    abstract public function GetById($id);
    abstract public function Delete($id);
    abstract public function GetAll();
}
