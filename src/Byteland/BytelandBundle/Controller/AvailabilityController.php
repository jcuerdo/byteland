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
        $entity = new Availability();

        //Todo set date and restaurant;

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $response = new JsonResponse('OK',JsonResponse::HTTP_CREATED ,array('Content-Type' => 'application/json'));
        
        return $response;
    }
}
