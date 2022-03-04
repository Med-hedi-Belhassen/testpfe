<?php

namespace WorkflowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Accessor;

/**
 * workflow
 *
 * @ORM\Table(name="workflow")
 * @ORM\Entity(repositoryClass="WorkflowBundle\Repository\workflowRepository")
 */
class workflow
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Expose
     * @Type("string")
     * @Accessor(getter="getNameW")
     * @ORM\Column(name="nameW", type="string", length=255)
     */
    protected $nameW;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionW", type="text")
     */
    protected $descriptionW;

    /**
     * @var string
     *
     * @ORM\Column(name="statusW", type="string", length=255)
     */
    protected $statusW;
    /**
     * Set id
     *
     * @param int $id
     *
     * @return workflow
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameW
     *
     * @param string $nameW
     *
     * @return workflow
     */
    public function setNameW($nameW)
    {
        $this->nameW = $nameW;

        return $this;
    }

    /**
     * Get nameW
     *
     * @return string
     */
    public function getNameW()
    {
        return $this->nameW;
    }

    /**
     * Set descriptionW
     *
     * @param string $descriptionW
     *
     * @return workflow
     */
    public function setDescriptionW($descriptionW)
    {
        $this->descriptionW = $descriptionW;

        return $this;
    }

    /**
     * Get descriptionW
     *
     * @return string
     */
    public function getDescriptionW()
    {
        return $this->descriptionW;
    }

    /**
     * Set statusW
     *
     * @param string $statusW
     *
     * @return workflow
     */
    public function setStatusW($statusW)
    {
        $this->statusW = $statusW;

        return $this;
    }

    /**
     * Get statusW
     *
     * @return string
     */
    public function getStatusW()
    {
        return $this->statusW;
    }

    public function convert($workflow)
    {
        $param = (array)$workflow;

        return ($param);
    }
    public function __get($property)
    {
        var_dump(__METHOD__);
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        var_dump(__METHOD__);
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
