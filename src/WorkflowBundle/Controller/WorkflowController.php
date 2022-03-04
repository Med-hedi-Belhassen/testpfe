<?php

namespace WorkflowBundle\Controller;

use WorkflowBundle\Entity\workflow;
use WorkflowBundle\Services\WorkflowService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/workflow")
 */
class WorkflowController extends Controller
{
    public $service;
    public function __construct()
    {
        $this->service = new WorkflowService();
    }

    /**
     * @Route("/get")
     * Method("GET")
     */
    public function getAllWorkflows()
    {
        $allworkflows = $this->service->GetAll();
        $response = new Response($this->get('jms_serializer')->serialize($allworkflows, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return new Response($response);
    }
    /**
     * @Route("/get/{id}")
     * Method("GET")
     */
    public function getWorkflowbyId($id)
    {
        $w = $this->service->GetById($id);
        $response = new Response($this->get('jms_serializer')->serialize($w, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return new Response($response);
    }

    /**
     * @Route("/edit")
     * @Method("POST")
     */
    public function newWorkflow(Request $request)
    {
        //getting the request parametters
        $data = json_decode($request->getContent(), true);
        $workflow = new workflow();
        $workflow->setNameW($data['nameW']);
        $workflow->setDescriptionW($data['descriptionW']);
        $workflow->setStatusW($data['statusW']);
        //calling the service to add the created workflow in database 
        $fparam = $this->service->Add($workflow);
        //creating the response
        $response = new Response($this->get('jms_serializer')->serialize($fparam, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return new Response($response);
    }

    /**
     * @Route("/edit/{id}")
     * @Method("PUT")
     */
    public function updateWorkflow(Request $request, $id)
    {
        //getting the request parameters 
        $data = json_decode($request->getContent(), true);
        $workflow = new workflow();
        $workflow->setNameW($data['nameW']);
        $workflow->setDescriptionW($data['descriptionW']);
        $workflow->setStatusW($data['statusW']);
        //modifying using the service 
        $fparam = $this->service->Modify($id, $workflow);
        //returning the response part 
        $response = new Response($this->get('jms_serializer')->serialize($fparam, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return new Response($response);
    }

    /**
     * @Route("/remove/{id}")
     * Method("DELETE")
     */
    public function deleteWorkflow($id)
    {
        $res = $this->service->Delete($id);
        $fdata = $this->get('jms_serializer')->serialize($res, 'json');
        if ($res > 0) {
            $response = new Response($fdata);
            $response->headers->set('Content-Type', 'application/json');
            return new Response($response);
        } else {
            $response = new Response(http_response_code(202));
            $response->headers->set('Content-Type', 'application/json');
            return new Response('errrreur ');
        }
    }
}
