<?php

namespace WorkflowBundle\Repository;

use WorkflowBundle\Entity\workflow;
use AppBundle\Repository\Repository;

class workflowRepository extends Repository
{
    public function add($workflow)
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
    public function edit($id, $workflow)
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
        $data = $this->conn->update('workflow', $fparam, ['id' => $id]);
        $fparam["id"] = $id;
        return $fparam;
    }
    public function findbyId($id)
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
    public function delete($id)
    {
        return  $this->conn->delete('workflow', ['id' => $id]);
    }
    public function find()
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
