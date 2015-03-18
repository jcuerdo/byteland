<?php

namespace Byteland\BytelandBundle\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Byteland\BytelandBundle\Entity\Restaurant;
use Byteland\BytelandBundle\Form\RestaurantType;

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
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BytelandBundle:Restaurant')->findAll();

        foreach($entities as $key => $entity)
        {
            $entities[$key] = array('id' => $entity->getId(),'name' => $entity->getName(),'max_accepted_people' => $entity->getMaxAcceptedPeople());
        }
        $response = new JsonResponse($entities,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

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

        $entity = new Restaurant();

        $entity->setName($request->get('name'));
        $entity->setMaxAcceptedPeople($request->get('max_accepted_people'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        return $response;
    }

    /**
     * Finds and displays a Restaurant entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BytelandBundle:Restaurant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Restaurant.');
        }

        $entity = array('id' => $entity->getId(),'name' => $entity->getName(),'max_accepted_people' => $entity->getMaxAcceptedPeople());

        $response = new JsonResponse($entity,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;

    }

    /**
     * Edits an existing Restaurant entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        parse_str($request->getContent(), $params);

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BytelandBundle:Restaurant')->find($id);

        if(!empty($params['name']))
        {
            $entity->setName($params['name']);
        }

        if(!empty($params['max_accepted_people']))
        {
            $entity->setMaxAcceptedPeople($params['max_accepted_people']);
        }


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Restaurant.');
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $response = new JsonResponse('OK',JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;

    }
    /**
     * Deletes a Restaurant entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BytelandBundle:Restaurant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Restaurant entity.');
        }

        $em->remove($entity);
        $em->flush();
        $response = new JsonResponse('OK',JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));

        return $response;
    }

    /**
     * Creates a form to delete a Restaurant entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('restaurant_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
