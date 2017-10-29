<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Beer;
use AppBundle\Entity\Measurement;
use AppBundle\Form\BeerType;
use AppBundle\Form\MeasurementType;
use AppBundle\Repository\BeerRepository;
use AppBundle\Repository\MeasurementRepository;
use JMS\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @Route("beer")
 */
class BeerController extends Controller
{
    /**
     * @Route("/", name="beerList")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->get(BeerRepository::class);
        $query = $repository->createQueryBuilder('b');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)
        );
        return $this->render('@App/beer/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
    /**
     * @Route("/add", name="addBeer")
     */
    public function addAction(Request $request)
    {
        $beer = new Beer();
        $form = $this->createForm(BeerType::class, $beer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository = $this->get(BeerRepository::class);
            $repository->persist($beer);

            $this->addFlash(
                'success',
                'Beer added'
            );

            return $this->redirectToRoute('showBeer', ['id'=> $beer->getId()]);
        }
        return $this->render('@App/beer/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="showBeer")
     */
    public function showAction(Beer $beer)
    {
        return $this->render('@App/beer/show.html.twig', [
            'beer' => $beer
        ]);
    }

    /**
     * @Route("/add-measurement/{id}", name="addMeasurementToBeer")
     */
    public function addMeasurement(Request $request, Beer $beer)
    {
        $measurement= new Measurement($beer);

        $form = $this->createForm(MeasurementType::class, $measurement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository = $this->get(MeasurementRepository::class);
            $repository->persist($measurement);

            $this->addFlash(
                'success',
                'Measurement added'
            );

            return $this->redirectToRoute('showBeer', ['id'=> $beer->getId()]);
        }
        return $this->render('@App/beer/addMeasurement.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/get-measurements/{id}", name="getMeasurementsForBeer")
     */
    public function getMeasurementsAction(Beer $beer)
    {
        /** @var Serializer $serializer */
        $serializer = $this->get('jms_serializer');
        $result = $serializer->serialize($beer->getMeasurements(), 'json');
        return new JsonResponse($result, 200, [], true);
    }
}
