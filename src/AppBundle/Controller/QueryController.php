<?php

namespace AppBundle\Controller;

use Doctrine\Bundle\DoctrineBundle\Registry;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class QueryController
 * @package AppBundle\Controller
 * @Route("/api/queries", service="controller.query")
 */
class QueryController
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * QueryController constructor.
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
        $result = $this->registry->getRepository(Query::class)->findAll();
        if ($result === null) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            return $response;
        }
        return $result;
    }

    /**
     * @param int $id
     * @return object|Response
     *
     * @Route("/{id}")
     * @Method({"GET"})
     */
    public function readAction(int $id)
    {
        $result = $this->registry->getRepository(Query::class)->find($id);
        if ($result === null) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            return $response;
        }
        return $result;
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
        $result = $em->getRepository(Query::class)->find($id);
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
     * @param Request $request
     * @return Response
     *
     * @Route("/")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $query = new Query();

        $query = $this->setQuery($query, $request);

        $registry = $this->registry->getManager();
        $registry->persist($query);
        $registry->flush();

        $response = new Response('{"id": "'.$query->getId().'"}', Response::HTTP_CREATED);
        $actual_link = "http://{$request->server->get('HTTP_HOST')}{$request->server->get('REQUEST_URI')}";
        $response->headers->set('Location',  $actual_link . $query->getId());
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
        $query = $this->registry->getRepository(Query::class)->find($id);
        if ($query === null) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            return $response;
        }
        $query = $this->setQuery($query, $request);

        $registry = $this->registry->getManager();
        $registry->persist($query);
        $registry->flush();

        $response = new Response();
        $actual_link = "http://{$request->server->get('HTTP_HOST')}{$request->server->get('REQUEST_URI')}";
        $response->headers->set('Location',  $actual_link . $query->getId());
        $response->setStatusCode(Response::HTTP_OK);
        return $response;
    }

    private function setQuery(Query $query, Request $request) {
        $request->request->has('report_id') && $query->setReportId($request->get('report_id'));
        $request->request->has('limit') && $query->setLimit($request->get('limit'));
        $request->request->has('sort_direction') && $query->setSortDirection($request->get('sort_direction'));
        $request->request->has('sort_column') && $query->setSortColumn($request->get('sort_column'));
        $request->request->has('display_name') && $query->setDisplayName($request->get('display_name'));
        $request->request->has('display_order') && $query->setDisplayOrder($request->get('display_order'));
        $request->request->has('favorite') && $query->setFavorite($request->get('favorite'));

        $request->request->has('fields') && $query->setFieldsFromArray($request->get('fields'));
        $request->request->has('filters') && $query->setFiltersFromArray($request->get('filters'));
        $request->request->has('orders') && $query->setOrdersFromArray($request->get('orders'));
        $request->request->has('widths') && $query->setWidthsFromArray($request->get('widths'));
        return $query;
    }
}