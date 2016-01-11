<?php
namespace Todos\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Todos\Entities\Todo;


class TodoController {




    public function getAllAction(Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Todos\\Entities\\Todo')->findAll());
      
    }


    public function getOneAction($id, Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Todos\\Entities\\Todo')->findOneBy(array('id' => $id)));
    }

    public function deleteOneAction($id, Application $app)
    {
        $todo = $app['doctrine.odm.mongodb.dm']->getRepository('Todos\\Entities\\Todo')->findOneBy(array('id' => $id));
        $app['doctrine.odm.mongodb.dm']->remove($todo); 
        $app['doctrine.odm.mongodb.dm']->flush();

        return new JsonResponse(200);
    }

    public function addOneAction(Application $app, Request $request)
    {

          $todo = new Todo($request->get("name"));

          $app['doctrine.odm.mongodb.dm']->persist($todo);
          $app['doctrine.odm.mongodb.dm']->flush();

        return new JsonResponse($todo, 201);
    }

    public function editOneAction($id, Application $app, Request $request)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $todo = $dm->getRepository('Todos\\Entities\\Todo')->findOneBy(array('id' => $id));

        $todo->setName($request->get("name"));
        $dm->flush($todo);


        return new JsonResponse($todo);
    }
}
