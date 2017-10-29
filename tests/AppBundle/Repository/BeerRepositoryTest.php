<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Beer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PHPUnit\Framework\TestCase;

class BeerRepositoryTest extends TestCase
{
    /** @var  BeerRepository */
    private $repository;
    private $em;

    protected function setUp()
    {
        $this->em = $this->createMock(EntityManagerInterface::class);
        $classMetadata = $this->createMock(ClassMetadata::class);
        $this->repository = new BeerRepository($this->em, $classMetadata);
    }

    /**
     * @test
     */
    public function shouldPersistBeer()
    {
        $beer = new Beer();
        $beer->setName('test');

        $this->em->expects($this->once())->method('persist')->with($beer);
        $this->em->expects($this->once())->method('flush');
        $this->repository->persist($beer);
    }


}
