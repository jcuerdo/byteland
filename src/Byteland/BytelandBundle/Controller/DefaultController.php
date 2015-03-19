<?php

namespace Byteland\BytelandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        //TODO: Print it wit RestFull format like https://github.com/theon/iodocs/blob/master/public/data/zoo.json
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
