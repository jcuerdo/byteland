<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $response = new JsonResponse(array(),JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));
        return $response;
    }


}
