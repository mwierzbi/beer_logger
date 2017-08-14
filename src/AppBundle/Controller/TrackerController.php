<?php

namespace AppBundle\Controller;

use AppBundle\Service\Tracker;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("tracker")
 */
class TrackerController extends Controller
{
    /**
     * @Route("/", name="tracker")
     */
    public function indexAction(Request $request)
    {
        /** @var Tracker $tracker */
        $tracker = $this->get(Tracker::class);
        $statusCode = Response::HTTP_OK;
        try{
            $mac = $request->get('mac', '');
            $value = $request->get('value', '');
            $tracker->track($mac, $value);
        }catch (\InvalidArgumentException $e) {
            $statusCode = Response::HTTP_BAD_REQUEST;
        }
        return new Response('', $statusCode);
    }
}
