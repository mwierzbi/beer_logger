<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 13.08.17
 * Time: 21:12
 */

namespace AppBundle\Service;


use AppBundle\Entity\LogData;

class LogDataFactory
{
    /**
     * @param string $mac
     * @param string $value
     * @return LogData
     */
    public function createLogData(string $mac, string $value):LogData
    {
        if ( $mac == '' || $value == '') {
            throw new \InvalidArgumentException();
        }
        $data = new LogData();
        $data->setMac($mac);
        $data->setValue($value);
        $data->setCreateDate(new \DateTime());
        return $data;
    }
}