<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Measurement
 *
 * @ORM\Table(name="measurement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeasurementRepository")
 */
class Measurement
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
     * @var bool
     * @ORM\Column(name="is_active", type="boolean", options={"default": false})
     */
    private $isActive;

    /**
     * @var Beer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Beer", inversedBy="measurements")
     */
    private $beer;

    /**
     * @var Device
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Device", inversedBy="measurements")
     */
    private $device;

    /**
     * @var LogData[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LogData", mappedBy="measurement")
     */
    private $logData;

    /**
     * Measurement constructor.
     * @param Beer $beer
     */
    public function __construct(Beer $beer)
    {
        $this->beer = $beer;
        $this->logData = new ArrayCollection();
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
     * @return Measurement
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
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool)$this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return Beer
     */
    public function getBeer()
    {
        return $this->beer;
    }

    /**
     * @param Beer $beer
     */
    public function setBeer(Beer $beer)
    {
        $this->beer = $beer;
    }

    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     */
    public function setDevice(Device $device)
    {
        $this->device = $device;
    }

    /**
     * @return LogData[]
     */
    public function getLogData()
    {
        return $this->logData;
    }

    public function getLastLogdata()
    {
        return $this->logData->last();
    }

    /**
     * @param LogData[] $logData
     */
    public function setLogData($logData)
    {
        $this->logData = $logData;
    }
}
