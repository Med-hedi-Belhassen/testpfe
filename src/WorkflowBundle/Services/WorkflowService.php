<?php
namespace \WorkflowBundle\Services;

use \AppBundle\AppServices\CoreService;

class WorkflowService extends CoreService
{
    public function Add($workflow)
    {
        return $this->conn;
    }
    public function Modify($id)
    {
        return $id;
    }
    public function GetById($id)
    {
        return $id;
    }
    public function Delete($id)
    {
        return $id;
    }
     public function GetAll()
     {
        return $this->conn;
     }
}
