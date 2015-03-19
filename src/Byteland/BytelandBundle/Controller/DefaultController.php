<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
        $schema = array(
            $baseurl . "/person",
            $baseurl . "/restaurant",
            $baseurl . "/booking",
            $baseurl . "/availability",

        );
        $response = new JsonResponse($schema,JsonResponse::HTTP_OK,array('Content-Type' => 'application/json'));
        return $response;
    }


}
