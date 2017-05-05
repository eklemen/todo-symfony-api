<?php

namespace AppBundle\Controller;

use Doctrine\Bundle\DoctrineBundle\Registry;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class TodoController
 * @package AppBundle\Controller
 * @Route("/api/todos", service="controller.todo")
 */
class TodoController
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * TodoController constructor.
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return object|Response
     *
     * @Route("/")
     * @Method({"GET"})
     */
    public function readAllAction()
    {
        $result = $this->registry->getRepository(Todo::class)->findAll();
        if ($result === null) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            return $response;
        }
        return $result;
    }

    /**
     * @return object|Response
     *
     * @Route("/{id}")
     * @Method({"GET"})
     */
    public function readAction(int $id)
    {
        $result = $this->registry->getRepository(Todo::class)->find($id);
        if ($result === null) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            return $response;
        }
        return $result;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $todo = new Todo();

        $todo = $this->setTodo($todo, $request);

        $registry = $this->registry->getManager();
        $registry->persist($todo);
        $registry->flush();

        $response = new Response('{"id": "'.$todo->getId().'"}', Response::HTTP_CREATED);
        $actual_link = "http://{$request->server->get('HTTP_HOST')}{$request->server->get('REQUEST_URI')}";
        $response->headers->set('Location',  $actual_link . $todo->getId());
        return $response;
    }

    /**
     * @param int $id
     * @return Response
     *
     * @Route("/{id}")
     * @Method({"DELETE"})
     */
    public function dropAction(int $id) {
        $em = $this->registry->getManager();
        $result = $em->getRepository(Todo::class)->find($id);
        $response = new Response();
        if ($result === null) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        } else {
            $em->remove($result);
            $em->flush();
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        }
        return $response;
    }

    /**
     * @param $id
     * @param Request $request
     * @return Response
     *
     * @Method({"PUT"})
     * @Route("/{id}")
     */
    public function updateAction($id, Request $request)
    {
        $todo = $this->registry->getRepository(Todo::class)->find($id);
        if ($todo === null) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            return $response;
        }
        $todo = $this->setTodo($todo, $request);
        $registry = $this->registry->getManager();
        $registry->persist($todo);
        $registry->flush();

        $response = new Response();
        $actual_link = "http://{$request->server->get('HTTP_HOST')}{$request->server->get('REQUEST_URI')}";
        $response->headers->set('Location',  $actual_link . $todo->getId());
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }

    private function setTodo(Todo $todo, Request $request) {
        $request->request->has('task') && $todo->setTask($request->get('task'));
        $todo->setIsComplete($request->get('is_complete'));
        return $todo;
    }
}