<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 13.08.17
 * Time: 20:48
 */

namespace AppBundle\Service;

use AppBundle\Entity\LogData;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class TrackerTest extends TestCase
{
    /** @var  EntityManager */
    private $em;
    /** @var  LogDataFactory */
    private $logDataFactory;
    /** @var  Tracker */
    private $service;

    protected function setUp()
    {
        $this->em = $this->createMock(EntityManager::class);
        $this->logDataFactory = $this->createMock(LogDataFactory::class);
        $this->service = new Tracker($this->em, $this->logDataFactory);
    }

    /**
     * @test
     */
    public function shouldPersistLogData()
    {
        $this->em->expects($this->once())->method('persist')->with($this->isInstanceOf(LogData::class));
        $this->em->expects($this->once())->method('flush');
        $this->service->track('mac address', 'test value');
    }
}
