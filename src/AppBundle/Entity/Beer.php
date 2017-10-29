<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Beer
 *
 * @ORM\Table(name="beer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BeerRepository")
 */
class Beer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Measurement[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Measurement", mappedBy="beer")
     */
    private $measurements;

    /**
     * Beer constructor.
     */
    public function __construct()
    {
        $this->measurements = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Beer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Measurement[]
     */
    public function getMeasurements()
    {
        return $this->measurements;
    }

    /**
     * @param Measurement[] $measurements
     */
    public function setMeasurements($measurements)
    {
        $this->measurements = $measurements;
    }


}

