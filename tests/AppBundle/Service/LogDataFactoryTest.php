<?php

namespace AppBundle\Service;

use AppBundle\Entity\LogData;
use AppBundle\Entity\Measurement;
use PHPUnit\Framework\TestCase;

class LogDataFactoryTest extends TestCase
{
    /** @var  LogDataFactory */
    private $factory;
    /** @var  Measurement */
    private $measurement;

    protected function setUp()
    {
        $this->measurement = $this->createMock(Measurement::class);
        $this->factory = new LogDataFactory();
    }

    /**
     * @test
     * @dataProvider validCreateDataProvider
     */
    public function shouldCreateLogDataObject($mac, $value)
    {
        $logData = $this->factory->createLogData($mac, $value, $this->measurement);
        $this->assertInstanceOf(LogData::class, $logData);
        $this->assertEquals($value, $logData->getValue());

        $expectedDate = new \DateTime();
        $this->assertEquals($expectedDate, $logData->getCreateDate());
    }

    public function validCreateDataProvider()
    {
        return [
            ['test', 'test'],
        ];
    }

    /**
     * @test
     * @dataProvider invalidCreateDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function shouldReturnExceptionOnInvalidParam($mac, $value)
    {
        $this->factory->createLogData($mac, $value, $this->measurement);
    }

    public function invalidCreateDataProvider()
    {
        return [
            ['', ''],
            ['sdsa', ''],
            ['', 'test']
        ];
    }
}
