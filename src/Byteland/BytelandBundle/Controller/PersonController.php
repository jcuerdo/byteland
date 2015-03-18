<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Byteland\BytelandBundle\Entity\Person;
use Byteland\BytelandBundle\Form\PersonType;

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
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BytelandBundle:Person')->findAll();
        foreach($entities as $key => $value)
        {
            $entities[$key] = array('id' => $value->getId(),'name' => $value->getName());
        }
        $response = new JsonResponse($entities,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));
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

        $entity = new Person();

        $entity->setName($request->get('name'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        return $response;
    }

    /**
     * Finds and displays a Person entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BytelandBundle:Person')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Person.');
        }

        $entity_data = array('id' => $entity->getId(),'name' => $entity->getName());

        foreach($entity->getBookings() as $key => $value)
        {
            $entity_data['bookings'][$key] = array(
                'id' => $value->getId(),
                'date' => $value->getDate()->format('d-m-Y'),
                'restaurant_id' => $value->getRestaurant()->getId()
            );
        }

        $response = new JsonResponse($entity_data,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;

    }

    /**
     * Edits an existing Person entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        parse_str($request->getContent(), $params);

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BytelandBundle:Person')->find($id);

        if(!empty($params['name']))
        {
            $entity->setName($params['name']);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

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
