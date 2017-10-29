<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Measurement;

/**
 * MeasurementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MeasurementRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param Measurement $measurement
     */
    public function persist(Measurement $measurement)
    {
        $em = $this->getEntityManager();
        $em->persist($measurement);
        $em->flush();
    }
}
