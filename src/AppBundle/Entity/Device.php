<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Device
 *
 * @ORM\Table(name="device")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeviceRepository")
 */
class Device
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
     * @ORM\Column(name="mac", type="string", length=255, unique=true)
     */
    private $mac;

    /**
     * @var string
     *
     * @ORM\Column(name="lastValue", type="string", length=255, nullable=true)
     */
    private $lastValue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastDate", type="datetime")
     */
    private $lastDate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var Measurement[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Measurement", mappedBy="device")
     */
    private $measurements;

    /**
     * Device constructor.
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
     * Set mac
     *
     * @param string $mac
     *
     * @return Device
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return string
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * Set lastValue
     *
     * @param string $lastValue
     *
     * @return Device
     */
    public function setLastValue($lastValue)
    {
        $this->lastValue = $lastValue;

        return $this;
    }

    /**
     * Get lastValue
     *
     * @return string
     */
    public function getLastValue()
    {
        return $this->lastValue;
    }

    /**
     * Set lastDate
     *
     * @param \DateTime $lastDate
     *
     * @return Device
     */
    public function setLastDate($lastDate)
    {
        $this->lastDate = $lastDate;

        return $this;
    }

    /**
     * Get lastDate
     *
     * @return \DateTime
     */
    public function getLastDate()
    {
        return $this->lastDate;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Device
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

    public function __toString()
    {
        return $this->name.' ('.$this->mac.') - '.$this->lastValue;
    }
}

