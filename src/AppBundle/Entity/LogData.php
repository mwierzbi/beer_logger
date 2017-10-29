<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * LogData
 *
 * @ORM\Table(name="log_data")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LogDataRepository")
 */
class LogData
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime")
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $createDate;

    /**
     * @var Measurement
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Measurement", inversedBy="logData")
     */
    private $measurement;


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
     * Set value
     *
     * @param string $value
     *
     * @return LogData
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return LogData
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return Measurement
     */
    public function getMeasurement(): Measurement
    {
        return $this->measurement;
    }

    /**
     * @param Measurement $measurement
     */
    public function setMeasurement(Measurement $measurement)
    {
        $this->measurement = $measurement;
    }


}

