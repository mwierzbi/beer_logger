<?php

namespace AppBundle\Service;

use AppBundle\Entity\Device;
use AppBundle\Entity\LogData;
use AppBundle\Entity\Measurement;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class TrackerTest extends TestCase
{
    /** @var  EntityManager */
    private $em;
    /** @var  LogDataFactory */
    private $logDataFactory;
    /** @var  DeviceFactory */
    private $deviceFactory;
    /** @var  Tracker */
    private $service;

    protected function setUp()
    {
        $this->em = $this->createMock(EntityManager::class);
        $this->logDataFactory = $this->createMock(LogDataFactory::class);
        $this->logDataFactory->method('createLogData')->willReturn(new LogData());
        $this->deviceFactory = $this->createMock(DeviceFactory::class);
        $this->service = new Tracker($this->em, $this->logDataFactory, $this->deviceFactory);
    }

    /**
     * @test
     */
    public function shouldPersistLastValue()
    {
        $device = new Device();
        $this->deviceFactory->method('createDevice')->willReturn($device);
        $this->service->track('mac address', 'test value');

        $this->assertEquals('test value', $device->getLastValue());
    }

    /**
     * @test
     */
    public function shouldPersistDataForActiveMeasurement()
    {

        $measurement = $this->createMock(Measurement::class);
        $measurement->method('isActive')->willReturn(true);
        $device = $this->createMock(Device::class);
        $device->method('getMeasurements')->willReturn([$measurement]);
        $this->deviceFactory->method('createDevice')->willReturn($device);

        $this->logDataFactory->expects($this->once())->method('createLogData');
        $this->service->track('mac address', 'test value');
    }

    /**
     * @test
     */
    public function shouldNotPersistDataForActiveMeasurement()
    {

        $measurement = $this->createMock(Measurement::class);
        $measurement->method('isActive')->willReturn(false);
        $device = $this->createMock(Device::class);
        $device->method('getMeasurements')->willReturn([$measurement]);
        $this->deviceFactory->method('createDevice')->willReturn($device);

        $this->logDataFactory->expects($this->never())->method('createLogData');
        $this->service->track('mac address', 'test value');
    }
}
