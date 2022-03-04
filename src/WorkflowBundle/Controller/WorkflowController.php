<?php

namespace WorkflowBundle\Controller;

use \AppBundle\Connection;
use Doctrine\DBAL\DriverManager;
use WorkflowBundle\Entity\workflow;
use Doctrine\DBAL\Driver\PDOStatement ;
use \WorkflowBundle\Services\WorkflowService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 /**
     * @Route("/workflow")
     */
class WorkflowController extends Controllser
{ 
   
    /**
     * @Route("/get")
     * Method("GET")
     */
    public function getAllWorkflows()
    {
    //getting all the data from db using dbal
    $connectionParams = [
        'dbname' => 'pfev1',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
    $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    $resultSet = $conn->executeQuery('SELECT * FROM workflow ');
    $workflows = $resultSet->fetchAll();
    $allworkflows= array();
    foreach ($workflows as $workflow) {
        $w=new workflow();
        $w->setId(intval($workflow["id"]));
        $w->setNameW($workflow["nameW"]);
        $w->setDescriptionW($workflow["descriptionW"]);
        $w->setStatusW($workflow["statusW"]);
        array_push($allworkflows,$w);
    }
    var_dump($allworkflows);
    $fdata = $this->get('jms_serializer')->serialize($allworkflows, 'json');
    
    $response = new Response($fdata);
    $response->headers->set('Content-Type', 'application/json');
    return new Response($response);
    }
    /**
     * @Route("/get/{id}")
     * Method("GET")
     */
    public function getWorkflowbyId($id)
    {
    //getting all the data from db using dbal
    $connectionParams = [
        'dbname' => 'pfev1',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
    $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    $workflow = $conn->fetchAll('SELECT * FROM workflow where id= ?', [$id]);
    $w=new workflow();
    foreach ($workflow as $var) {
        $w->setId(intval($id));
        $w->setNameW($var["nameW"]);
        $w->setDescriptionW($var["descriptionW"]);
        $w->setStatusW($var["statusW"]);
    }
    $fdata = $this->get('jms_serializer')->serialize($w, 'json');
    
    $response = new Response($fdata);
    $response->headers->set('Content-Type', 'application/json');
    return new Response($response);
    }

    /**
     * @Route("/post")
     * @Method("POST")
     */
   public function newWorkflow(Request $request){
    $data = json_decode($request->getContent(), true);
    $workflow=new workflow();
    $workflow->setNameW($data['nameW']);
    $workflow->setDescriptionW($data['descriptionW']);
    $workflow->setStatusW($data['statusW']);
    //adding to the data base using dbal
    $connectionParams = [
        'dbname' => 'pfev1',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
    $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
  //généralisation des paramétres 
    $param =$workflow->convert($workflow);
    $keys=array();
    $values=array();
    array_shift($param);
   foreach ($param as $key => $value) {
        $key=substr($key, 32);
        array_push($keys,$key);
        array_push($values,$value);
   }
   $fparam=array_combine($keys,$values);
   $data=$conn->insert('workflow',$fparam);
   $fparam['id']=intval($conn->LastInsertID());
    //returning the response part 
    $fdata = $this->get('jms_serializer')->serialize($fparam, 'json');
    $response = new Response($fdata);
    $response->headers->set('Content-Type', 'application/json');
    return new Response($response);
   }

    /**
     * @Route("/edit/{id}")
     * @Method("PUT")
     */
   public function updateWorkflow(Request $request ,$id){

    $workflow=new workflow();
    $workflow->setNameW($data['nameW']);
    $workflow->setDescriptionW($data['descriptionW']);
    $workflow->setStatusW($data['statusW']);
    //adding to the data base using dbal
    $connectionParams = [
        'dbname' => 'pfev1',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
    $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
  //généralisation des paramétres 
    $param =$workflow->convert($workflow);
    $keys=array();
    $values=array();
    array_shift($param);
   foreach ($param as $key => $value) {
        $key=substr($key, 32);
        array_push($keys,$key);
        array_push($values,$value);
   }
   $fparam=array_combine($keys,$values);
   $data=$conn->update('workflow',$fparam, ['id' => $id]);
    //returning the response part 
    $fdata = $this->get('jms_serializer')->serialize($fparam, 'json');
    $response = new Response($fdata);
    $response->headers->set('Content-Type', 'application/json');
    return new Response($response);
   }

    /**
     * @Route("/remove/{id}")
     * Method("DELETE")
     */
    public function deleteWorkflow($id)
    {
    //getting all the data from db using dbal
    $connectionParams = [
        'dbname' => 'pfev1',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
    $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    $res=$conn->delete('workflow', ['id' => $id]);


    var_dump($res);
    $fdata = $this->get('jms_serializer')->serialize($res, 'json');
    if($fdata>0){
        $response = new Response($fdata);
        $response->headers->set('Content-Type', 'application/json');
        return new Response($response);
    }
    else{
        $response = new Response(http_response_code(202));
        $response->headers->set('Content-Type', 'application/json');  
        return new Response('errrreur ');
    }
    
    }
}


