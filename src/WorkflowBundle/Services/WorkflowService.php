<?php

namespace WorkflowBundle\Services;

use WorkflowBundle\Entity\workflow;
use AppBundle\AppServices\CoreService;


class WorkflowService extends CoreService
{
    //adding a workflow to database 
    public function Add($workflow)
    {
        $param = $workflow->convert($workflow);
        $keys = array();
        $values = array();
        array_shift($param);
        foreach ($param as $key => $value) {
            $key = substr($key, 32);
            array_push($keys, $key);
            array_push($values, $value);
        }
        $fparam = array_combine($keys, $values);
        $data = $this->conn->insert('workflow', $fparam);
        $fparam['id'] = intval($this->conn->LastInsertID());
        return $fparam;
    }


    public function Modify($id, $workflow)
    {
        //généralisation des paramétres 
        $param = $workflow->convert($workflow);
        $keys = array();
        $values = array();
        array_shift($param);
        foreach ($param as $key => $value) {
            $key = substr($key, 32);
            array_push($keys, $key);
            array_push($values, $value);
        }
        $fparam = array_combine($keys, $values);
        $data = $this->conn->update('workflow', $fparam, ['id' => $id]);

        return $fparam;
    }
    public function GetById($id)
    {
        $workflow = $this->conn->fetchAll('SELECT * FROM workflow where id= ?', [$id]);
        $w = new workflow();
        foreach ($workflow as $var) {
            $w->setId(intval($id));
            $w->setNameW($var["nameW"]);
            $w->setDescriptionW($var["descriptionW"]);
            $w->setStatusW($var["statusW"]);
        }
        return $w;
    }
    public function Delete($id)
    {
        $res = $this->conn->delete('workflow', ['id' => $id]);
        return $res;
    }
    public function GetAll()
    {
        $resultSet = $this->conn->executeQuery('SELECT * FROM workflow ');
        $workflows = $resultSet->fetchAll();
        $allworkflows = array();
        foreach ($workflows as $workflow) {
            $w = new workflow();
            $w->setId(intval($workflow["id"]));
            $w->setNameW($workflow["nameW"]);
            $w->setDescriptionW($workflow["descriptionW"]);
            $w->setStatusW($workflow["statusW"]);
            array_push($allworkflows, $w);
        }
        return $allworkflows;
    }
}
