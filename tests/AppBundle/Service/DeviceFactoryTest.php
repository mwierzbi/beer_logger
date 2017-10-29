<?php

namespace AppBundle\Service;

use AppBundle\Entity\Device;
use AppBundle\Repository\DeviceRepository;
use PHPUnit\Framework\TestCase;

class DeviceFactoryTest extends TestCase
{
    /** @var  DeviceFactory */
    private $factory;
    /** @var  DeviceRepository */
    private $deviceRepository;

    protected function setUp()
    {
        $this->deviceRepository = $this->createMock(DeviceRepository::class);
        $this->factory = new DeviceFactory($this->deviceRepository);
    }

    /**
     * @test
     */
    public function shouldBuildDevice()
    {
        $device = $this->factory->createDevice('test mac');

        $this->assertInstanceOf(Device::class, $device);
        $this->assertEquals('test mac', $device->getMac());
    }

    /**
     * @test
     */
    public function shouldFindDeviceInRepository()
    {
        $this->deviceRepository->expects($this->once())->method('findByMac');
        $device = $this->factory->createDevice('test mac');
    }
}
