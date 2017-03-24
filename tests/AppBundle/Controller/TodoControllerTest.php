<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\QueryController;
use AppBundle\Entity\Query;
use AppBundle\Repository\QueryRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class QueryControllerTest extends TestCase
{
    public function testReadActionWithNullResult()
    {
        $controller = $this->createReadableController(null);
        $result = $controller->readAction(1);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NOT_FOUND);
    }

    public function testReadActionWithValidResult()
    {
        $expected = ['one', 'two', 'three'];
        $controller = $this->createReadableController(['one', 'two', 'three']);
        $result = $controller->readAction(1);
        $this->assertEquals($result, $expected);
    }

    public function testReadAllActionWithNullResult()
    {
        $controller = $this->createReadableController(null);
        $result = $controller->readAllAction();
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NOT_FOUND);
    }

    public function testReadAllActionWithValidResult()
    {
        $expected = ['one', 'two', 'three'];
        $controller = $this->createReadableController(['one', 'two', 'three']);
        $result = $controller->readAllAction(1);
        $this->assertEquals($result, $expected);
    }

    public function testDropActionWithNullResult() {
        $controller = $this->createDeleteableController(null);
        $result = $controller->dropAction(1);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NOT_FOUND);
    }

    public function testDropActionWithValidResult() {
        $controller = $this->createDeleteableController(["one", "two", "three"]);

        $result = $controller->dropAction(1);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NO_CONTENT);
    }

    private function createDeleteableController($result = null) {
        $repoStub = $this->createMock(QueryRepository::class);
        $repoStub->method("find")->willReturn($result);

        $managerStub = $this->createMock(EntityManager::class);
        $managerStub->method("getRepository")->willReturn($repoStub);

        $registryStub = $this->createMock(Registry::class);
        $registryStub->method("getManager")->willReturn($managerStub);

        return new QueryController($registryStub);
    }

    private function createReadableController($results = null) {
        $repoStub = $this->createMock(QueryRepository::class);
        $repoStub->method("find")->willReturn($results);
        $repoStub->method("findAll")->willReturn($results);
        $registryStub = $this->createMock(Registry::class);
        $registryStub->method("getRepository")->willReturn($repoStub);
        return new QueryController($registryStub);
    }

    public function testCreateAction() {
        $registryStub = $this->createMock(Registry::class);
        $managerStub = $this->createMock(EntityManager::class);
        $registryStub->method("getManager")->willReturn($managerStub);
        $controller = new QueryController($registryStub);
        $result = $controller->createAction(new Request());
        $this->assertEquals($result->getStatusCode(), Response::HTTP_CREATED);
    }

    public function testUpdateActionWithNullResult() {
        $repoStub = $this->createMock(QueryRepository::class);
        $repoStub->method("find")->willReturn(null);

        $managerStub = $this->createMock(EntityManager::class);

        $registryStub = $this->createMock(Registry::class);

        $registryStub->method("getManager")->willReturn($managerStub);
        $registryStub->method("getRepository")->willReturn($repoStub);

        $controller = new QueryController($registryStub);
        $result = $controller->updateAction(123, new Request());
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NOT_FOUND);
    }

    public function testUpdateActionWithValidResult() {
        $queryStub = $this->createMock(Query::class);

        $repoStub = $this->createMock(QueryRepository::class);
        $repoStub->method("find")->willReturn($queryStub);

        $managerStub = $this->createMock(EntityManager::class);

        $registryStub = $this->createMock(Registry::class);

        $registryStub->method("getManager")->willReturn($managerStub);
        $registryStub->method("getRepository")->willReturn($repoStub);

        $controller = new QueryController($registryStub);
        $result = $controller->updateAction(123, new Request());
        $this->assertEquals($result->getStatusCode(), Response::HTTP_OK);
    }

}
