<?php

namespace AppBundle\Service;

use AppBundle\Entity\Device;
use AppBundle\Repository\DeviceRepository;

class DeviceFactory
{
    /** @var  DeviceRepository */
    private $deviceRepository;

    /**
     * DeviceFactory constructor.
     * @param DeviceRepository $deviceRepository
     */
    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }


    public function createDevice(string $mac):Device
    {
        $device = $this->deviceRepository->findByMac($mac);

        if (!$device) {
            $device = new Device();
        }
        $device->setMac($mac);
        return $device;
    }
}
