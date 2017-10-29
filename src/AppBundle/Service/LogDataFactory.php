<?php

namespace AppBundle\Service;


use AppBundle\Entity\LogData;
use AppBundle\Entity\Measurement;

class LogDataFactory
{
    /**
     * @param string $mac
     * @param string $value
     * @param Measurement $measurement
     * @return LogData
     */
    public function createLogData(string $mac, string $value, Measurement $measurement):LogData
    {
        if ( $mac == '' || $value == '') {
            throw new \InvalidArgumentException();
        }
        $data = new LogData();
        $data->setValue($value);
        $data->setCreateDate(new \DateTime());
        $data->setMeasurement($measurement);
        return $data;
    }
}