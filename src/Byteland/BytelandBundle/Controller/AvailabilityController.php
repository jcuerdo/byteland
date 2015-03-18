<?php

namespace Byteland\BytelandBundle\Controller;

use Byteland\BytelandDomain\Model\Restaurant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Byteland\BytelandDomain\Model\Availability;
use Symfony\Component\HttpFoundation\JsonResponse;

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
            $response = new JsonResponse('ERROR',JsonResponse::HTTP_BAD_REQUEST ,array('Content-Type' => 'application/json'));
            return $response;
        }

        $restaurant = new Restaurant($request->get('id_restaurant'), '');
        $availability = new Availability(null, new \DateTime($request->get('date')),$restaurant);

        $availability_repository = $this->get('availability.repository');

        $availability_repository->add($availability);

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        
        return $response;
    }
}
