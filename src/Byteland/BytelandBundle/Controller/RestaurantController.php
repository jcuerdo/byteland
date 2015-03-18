<?php

namespace Byteland\BytelandBundle\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Byteland\BytelandDomain\Model\Restaurant;

/**
 * Restaurant controller.
 *
 */
class RestaurantController extends Controller
{
    /**
     * Lists all Restaurant entities.
     *
     */
    public function indexAction()
    {
        $restaurant_repository = $this->get('restaurant.repository');

        $restaurants = $restaurant_repository->findAll();

        foreach($restaurants as $key => $restaurant)
        {
            $restaurants[$key] = array(
                'id' => $restaurant->getId(),
                'name' => $restaurant->getName(),
                'max_accepted_persons' => $restaurant->getMaxAcceptedPeople()
            );
        }
        $response = new JsonResponse($restaurants,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));
        return $response;
    }
    /**
     * Creates a new Restaurant entity.
     *
     */
    public function createAction(Request $request)
    {
        if(!$request->get('name') || !$request->get('max_accepted_people')) {
            $response = new JsonResponse('ERROR',JsonResponse::HTTP_BAD_REQUEST ,array('Content-Type' => 'application/json'));
            return $response;
        }

        $restaurant = new Restaurant(null, $request->get('name'),$request->get('max_accepted_people'));

        $restaurant_repository = $this->get('restaurant.repository');

        $restaurant_repository->add($restaurant);

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        return $response;
    }

    /**
     * Finds and displays a Restaurant entity.
     *
     */
    public function showAction($id)
    {
        $restaurant_repository = $this->get('restaurant.repository');

        $restaurant = $restaurant_repository->find($id);

        $restaurant_data = array('id' => $restaurant->getId(),'name' => $restaurant->getName());

        foreach($restaurant->getBookings() as $key => $booking)
        {
            $restaurant_data['bookings'][$key] = array(
                'id' => $booking->getId(),
                'date' => $booking->getDate()->format('d-m-Y'),
                'person_id' => $booking->getPerson()->getId()
            );
        }

        foreach($restaurant->getAvailabilities() as $key => $availability)
        {
            $restaurant_data['availabilities'][$key] = array(
                'id' => $availability->getId(),
                'date' => $availability->getDate()->format('d-m-Y'),
            );
        }

        $response = new JsonResponse($restaurant_data,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;

    }

    /**
     * Edits an existing Restaurant entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        parse_str($request->getContent(), $params);

        $restaurant = new Restaurant($id, $params['name'], $params['max_accepted_people']);
        $restaurant_repository = $this->get('restaurant.repository');
        $restaurant_repository->edit($restaurant);

        $response = new JsonResponse('OK',JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;

    }
    /**
     * Deletes a Restaurant entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $restaurant_repository = $this->get('restaurant.repository');
        $restaurant_repository->remove($id);

        $response = new JsonResponse('OK',JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;
    }
}
