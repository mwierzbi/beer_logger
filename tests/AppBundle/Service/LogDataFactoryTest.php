<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 13.08.17
 * Time: 21:12
 */

namespace AppBundle\Service;

use AppBundle\Entity\LogData;
use PHPUnit\Framework\TestCase;

class LogDataFactoryTest extends TestCase
{
    /** @var  LogDataFactory */
    private $factory;

    protected function setUp()
    {
        $this->factory = new LogDataFactory();
    }

    /**
     * @test
     * @dataProvider validCreateDataProvider
     */
    public function shouldCreateLogDataObject($mac, $value)
    {
        $logData = $this->factory->createLogData($mac, $value);
        $this->assertInstanceOf(LogData::class, $logData);
        $this->assertEquals($mac,$logData->getMac());
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
        $this->factory->createLogData($mac, $value);
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
