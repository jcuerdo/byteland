<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Byteland\BytelandBundle\Entity\Booking;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Booking controller.
 *
 */
class BookingController extends Controller
{
    /**
     * Creates a new Booking entity.
     *
     */
    public function createAction(Request $request)
    {
        if(!$request->get('id_restaurant') || !$request->get('id_person') || !$request->get('date')) {
            $response = new JsonResponse('ERROR',JsonResponse::HTTP_BAD_REQUEST ,array('Content-Type' => 'application/json'));
            return $response;
        }

        $entity = new Booking();

        $em = $this->getDoctrine()->getManager();

        $entity->setDate(new \DateTime($request->get('date')));
        
        $restaurant = $em->getRepository('BytelandBundle:Restaurant')->find($request->get('id_restaurant'));

        $bookings =  $em->getRepository('BytelandBundle:Booking')->findByDate($restaurant, new \DateTime($request->get('date')));

        $availability =  $em->getRepository('BytelandBundle:Availability')->findByDate($restaurant, new \DateTime($request->get('date')));

        if(count($bookings) >= $restaurant->getMaxAcceptedPeople()) {
            $response = new JsonResponse('RESTAURANT FULL',JsonResponse::HTTP_PRECONDITION_REQUIRED ,array('Content-Type' => 'application/json'));
            return $response;
        }
        if(count($availability) == 0){
            $response = new JsonResponse('RESTAURANT NOT AVAILABLE',JsonResponse::HTTP_PRECONDITION_REQUIRED ,array('Content-Type' => 'application/json'));
            return $response;
        }

        $person = $em->getRepository('BytelandBundle:Person')->find($request->get('id_person'));
        $entity->setRestaurant($restaurant);
        $entity->setPerson($person);

        $em->persist($entity);
        $em->flush();

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        
        return $response;
    }
}
