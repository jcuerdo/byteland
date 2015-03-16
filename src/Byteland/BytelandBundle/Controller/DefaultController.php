<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $response = new JsonResponse($name,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));
        return $response;
        //return $this->render('BytelandBundle:Default:index.html.twig', array('name' => $name));
    }
}
