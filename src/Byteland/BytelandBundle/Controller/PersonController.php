<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Byteland\BytelandDomain\Model\Person;

/**
 * Person controller.
 *
 */
class PersonController extends Controller
{
    /**
     * Lists all Person entities.
     *
     */
    public function indexAction()
    {
        $person_repository = $this->get('person.repository');

        $persons = $person_repository->findAll();

        foreach($persons as $key => $value)
        {
            $persons[$key] = array('id' => $value->getId(),'name' => $value->getName());
        }
        $response = new JsonResponse($persons,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));
        return $response;
    }
    /**
     * Creates a new Person entity.
     *
     */
    public function createAction(Request $request)
    {
        if(!$request->get('name')) {
            $response = new JsonResponse('ERROR',JsonResponse::HTTP_BAD_REQUEST ,array('Content-Type' => 'application/json'));
            return $response;
        }

        $person = new Person(null, $request->get('name'));
        $person_repository = $this->get('person.repository');
        $person_repository->add($person);

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        return $response;
    }

    /**
     * Finds and displays a Person entity.
     *
     */
    public function showAction($id)
    {
        $person_repository = $this->get('person.repository');

        $person = $person_repository->find($id);

        $person_data = array('id' => $person->getId(),'name' => $person->getName());

        foreach($person->getBookings() as $key => $value)
        {
            $person_data['bookings'][$key] = array(
                'id' => $value->getId(),
                'date' => $value->getDate()->format('d-m-Y'),
                'restaurant_id' => $value->getRestaurant()->getId()
            );
        }

        $response = new JsonResponse($person_data,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;

    }

    /**
     * Edits an existing Person entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        parse_str($request->getContent(), $params);

        $person = new Person($id,$request->get('name'));

        $person_repository = $this->get('person.repository');

        $person_repository->edit($person);

        $response = new JsonResponse('OK',JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;
    }
    /**
     * Deletes a Person entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BytelandBundle:Person')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $em->remove($entity);
        $em->flush();
        $response = new JsonResponse('OK',JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;
    }
}
