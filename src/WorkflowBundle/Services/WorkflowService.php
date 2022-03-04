<?php

namespace WorkflowBundle\Services;

use WorkflowBundle\Entity\workflow;
use AppBundle\AppServices\CoreService;
use WorkflowBundle\Repository\workflowRepository;


class WorkflowService extends CoreService
{
    public $workflowRepository;
    public function __construct()
    {
        $this->workflowRepository = new workflowRepository();
    }
    //adding a workflow to database 
    public function Add($workflow)
    {

        $fparam = $this->workflowRepository->add($workflow);
        return $fparam;
    }


    public function Modify($id, $workflow)
    {
        //généralisation des paramétres
        $fparam = $this->workflowRepository->edit($id, $workflow);
        return $fparam;
    }
    public function GetById($id)
    {
        $w = $this->workflowRepository->findbyId($id);
        return $w;
    }
    public function Delete($id)
    {
        $res = $this->workflowRepository->delete($id);
        return $res;
    }
    public function GetAll()
    {
        $allworkflows = $this->workflowRepository->find();
        return $allworkflows;
    }
}
