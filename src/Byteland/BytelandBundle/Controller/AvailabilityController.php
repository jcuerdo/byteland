<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Byteland\BytelandBundle\Entity\Availability;
use Byteland\BytelandBundle\Form\AvailabilityType;
use Symfony\HttpFoundation\JsonResponse;

/**
 * Availability controller.
 *
 */
class AvailabilityController extends Controller
{
    /**
     * Creates a new Availability entity.
     *
     */
    public function createAction(Request $request)
    {
        if(!$request->get('id_restaurant') || !$request->get('date')) {
            $response = new JsonResponse('ERROR',JsonResponse::HTTP_PRECONDITION_REQUIRED ,array('Content-Type' => 'application/json'));
            return $response;
        }

        $entity = new Availability();

        $em = $this->getDoctrine()->getManager();

        $entity->setDate(strtotime($request->get('date')));
        
        $restaurant = $em->getRepository('BytelandBundle:Restaurant')->find($request->get('id_restaurant'));
        $entity->setRestaurant($restaurant);

        $em->persist($entity);
        $em->flush();

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        
        return $response;
    }
}
