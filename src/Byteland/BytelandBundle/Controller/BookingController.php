<?php

namespace Byteland\BytelandBundle\Controller;

use Byteland\BytelandDomain\Model\Restaurant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Byteland\BytelandDomain\Model\Person;
use \Byteland\BytelandDomain\Model\Booking;
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
        try{
            if(!$request->get('id_restaurant') || !$request->get('id_person') || !$request->get('date')) {
                $response = new JsonResponse('ERROR',JsonResponse::HTTP_BAD_REQUEST ,array('Content-Type' => 'application/json'));
                return $response;
            }

            $restaurant = new Restaurant($request->get('id_restaurant'),'');
            $person = new Person($request->get('id_person'),'');
            $booking = new Booking(null,new \DateTime($request->get('date')), $restaurant, $person);
            $booking_repository = $this->get('booking.repository');

            $booking_repository->add($booking);

            $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        }
        catch(\Exception $e) {
            $response = new JsonResponse($e->getMessage(),JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        }
        return $response;
    }
}
