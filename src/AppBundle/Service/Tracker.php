<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 13.08.17
 * Time: 20:41
 */

namespace AppBundle\Service;


use AppBundle\Entity\LogData;
use Doctrine\ORM\EntityManager;

class Tracker
{
    /** @var  EntityManager */
    private $em;
    /** @var  LogDataFactory */
    private $logDataFactory;

    /**
     * Tracker constructor.
     * @param EntityManager $em
     * @param LogDataFactory $dataFactory
     */
    public function __construct(EntityManager $em, LogDataFactory $dataFactory)
    {
        $this->em = $em;
        $this->logDataFactory = $dataFactory;
    }

    /**
     * @param string $mac
     * @param string $value
     */
    public function track(string $mac, string $value)
    {
        $data = $this->logDataFactory->createLogData($mac, $value);

        $this->em->persist($data);
        $this->em->flush();
    }
}