<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Byteland\BytelandBundle\Entity\Booking;
use Byteland\BytelandBundle\Form\BookingType;

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
        $entity = new Booking();

        //Todo set date, restaurant and person;

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        
        return $response;
    }
}
