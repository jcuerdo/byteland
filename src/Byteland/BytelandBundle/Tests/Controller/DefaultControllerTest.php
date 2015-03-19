<?php

namespace Byteland\BytelandBundle\Tests\Controller;

use Byteland\BytelandBundle\Controller\DefaultController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class DefaultControllerTest extends WebTestCase
{
    public function testGetCorrectSchema()
    {
        $controller = new DefaultController();
        $request = new Request();
        $result = $controller->indexAction($request);
        $schema = json_decode($result->getContent());

        $this->assertTrue(strpos($schema[0], '/person') >= 0);
        $this->assertTrue(strpos($schema[0], '/restaurant') >= 0);
        $this->assertTrue(strpos($schema[0], '/booking') >= 0);
        $this->assertTrue(strpos($schema[0], '/availability') >= 0);
    }
}
