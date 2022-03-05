<?php

use PHPUnit\Framework\TestCase;
use WorkflowBundle\Entity\workflow;
use WorkflowBundle\Services\WorkflowService;

class WorkflowServiceTest extends TestCase
{
    public function testgetByIdTest()
    {
        $workflowService = new WorkflowService();
        $workflowService->GetById(1);
        $workflow = new workflow();
        $workflow->setId(1);
        $workflow->setNameW("aa");
        $workflow->setDescriptionW("bbbbbbbbbbbb");
        $workflow->setStatusW("1");
        $this->assertEquals($workflow, $workflowService->GetById(1));
    }
}
