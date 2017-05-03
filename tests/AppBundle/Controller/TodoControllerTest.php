<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\TodoController;
use AppBundle\Entity\Todo;
use AppBundle\Repository\TodoRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TodoControllerTest extends TestCase
{
    public function testReadAllActionWithNullResult()
    {
        $controller = $this->createReadableController(null);
        $result = $controller->readAllAction(null);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NOT_FOUND);
    }

    public function testReadAllActionWithValidResult()
    {
        $controller = $this->createReadableController(new Response());
        $result = $controller->readAllAction(1);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_OK);
    }

    public function testReadActionWithNullResult()
    {
        $controller = $this->createReadableController(null);
        $result = $controller->readAction(1);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NOT_FOUND);
    }

    public function testReadActionWithValidResult()
    {
        $controller = $this->createReadableController(new Response());
        $result = $controller->readAction(1);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_OK);
    }

    public function testCreateAction() 
    {
        $registryStub = $this->createMock(Registry::class);
        $managerStub = $this->createMock(EntityManager::class);
        $registryStub->method("getManager")->willReturn($managerStub);
        $controller = new TodoController($registryStub);
        $result = $controller->createAction(new Request());
        $this->assertEquals($result->getStatusCode(), Response::HTTP_CREATED);
    }

    public function testDropActionWithNullResult() 
    {
        $controller = $this->createDeleteableController(null);
        $result = $controller->dropAction(1);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NOT_FOUND);
    }

    public function testDropActionWithValidResult() 
    {
        $controller = $this->createDeleteableController(new Response());
        $result = $controller->dropAction(1);
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NO_CONTENT);
    }

    public function testUpdateActionWithNullResult() {
        $repoStub = $this->createMock(TodoRepository::class);
        $repoStub->method("find")->willReturn(null);
        $managerStub = $this->createMock(EntityManager::class);
        $registryStub = $this->createMock(Registry::class);
        $registryStub->method("getManager")->willReturn($managerStub);
        $registryStub->method("getRepository")->willReturn($repoStub);
        $controller = new TodoController($registryStub);
        $result = $controller->updateAction(123, new Request());
        $this->assertEquals($result->getStatusCode(), Response::HTTP_NOT_FOUND);
    }

    public function testUpdateActionWithValidResult() {
        $todoStub = $this->createMock(Todo::class);
        $repoStub = $this->createMock(TodoRepository::class);
        $repoStub->method("find")->willReturn($todoStub);
        $managerStub = $this->createMock(EntityManager::class);
        $registryStub = $this->createMock(Registry::class);
        $registryStub->method("getManager")->willReturn($managerStub);
        $registryStub->method("getRepository")->willReturn($repoStub);
        $controller = new TodoController($registryStub);
        $result = $controller->updateAction(123, new Request());
        $this->assertEquals($result->getStatusCode(), Response::HTTP_OK);
    }

    private function createReadableController($results = null) 
    {
        $repoStub = $this->createMock(TodoRepository::class);
        $repoStub->method("find")->willReturn($results);
        $repoStub->method("findAll")->willReturn($results);
        $registryStub = $this->createMock(Registry::class);
        $registryStub->method("getRepository")->willReturn($repoStub);
        return new TodoController($registryStub);
    }

    private function createDeleteableController($result = null) 
    {
        $repoStub = $this->createMock(TodoRepository::class);
        $repoStub->method("find")->willReturn($result);
        $managerStub = $this->createMock(EntityManager::class);
        $managerStub->method("getRepository")->willReturn($repoStub);
        $registryStub = $this->createMock(Registry::class);
        $registryStub->method("getManager")->willReturn($managerStub);

        return new TodoController($registryStub);
    }

    
    

    // public function testUpdateActionWithValidResult() {
    //     $todoStub = $this->createMock(Todo::class);

    //     $repoStub = $this->createMock(TodoRepository::class);
    //     $repoStub->method("find")->willReturn($todoStub);

    //     $managerStub = $this->createMock(EntityManager::class);

    //     $registryStub = $this->createMock(Registry::class);

    //     $registryStub->method("getManager")->willReturn($managerStub);
    //     $registryStub->method("getRepository")->willReturn($repoStub);

    //     $controller = new TodoController($registryStub);
    //     $result = $controller->updateAction(123, new Request());
    //     $this->assertEquals($result->getStatusCode(), Response::HTTP_OK);
    // }

}
