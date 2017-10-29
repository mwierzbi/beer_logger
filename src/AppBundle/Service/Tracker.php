<?php

namespace AppBundle\Service;


use AppBundle\Entity\LogData;
use AppBundle\Repository\DeviceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class Tracker
{
    /** @var  EntityManagerInterface */
    private $em;
    /** @var  LogDataFactory */
    private $logDataFactory;
    /** @var  DeviceFactory */
    private $deviceFactory;

    /**
     * Tracker constructor.
     * @param EntityManagerInterface $em
     * @param LogDataFactory $logDataFactory
     * @param DeviceFactory $deviceFactory
     */
    public function __construct(EntityManagerInterface $em, LogDataFactory $logDataFactory, DeviceFactory $deviceFactory)
    {
        $this->em = $em;
        $this->logDataFactory = $logDataFactory;
        $this->deviceFactory = $deviceFactory;
    }

    /**
     * @param string $mac
     * @param string $value
     */
    public function track(string $mac, string $value)
    {
        $device = $this->trackDevice($mac, $value);
        $measurements = $device->getMeasurements();

        foreach ($measurements as $measurement) {
            if ($measurement->isActive()) {
                $data = $this->logDataFactory->createLogData($mac, $value, $measurement);
                $this->em->persist($data);
            }
        }


        $this->em->persist($device);
        $this->em->flush();
    }

    /**
     * @param string $mac
     * @param string $value
     * @return \AppBundle\Entity\Device
     */
    private function trackDevice(string $mac, string $value): \AppBundle\Entity\Device
    {
        $device = $this->deviceFactory->createDevice($mac);
        $device->setLastValue($value);
        $device->setLastDate(new \DateTime());
        return $device;
    }
}