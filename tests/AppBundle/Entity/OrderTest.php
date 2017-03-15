<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Order;
use AppBundle\Entity\Query;
use PHPUnit\Framework\TestCase;

class OrderEntityTest extends TestCase
{
    /**
     * @var Order
     */
    private $order;
    public function setUp()
    {
        $this->order = new Order();
    }
    public function testConstructor()
    {
        $this->assertInstanceOf(Order::class, $this->order);
    }

    public function testGetId() {
        $id = $this->order->getId();
        $this->assertEquals($id, null);
    }

    public function testGetSetColumn() {
        $this->order->setColumn("testLabel");
        $this->assertEquals($this->order->getColumn(), "testLabel");
    }

    public function testGetSetOrder() {
        $this->order->setOrder(123);
        $this->assertEquals($this->order->getOrder(), 123);
    }

    public function testGetSetQuery() {
        $queryMock = $this->getMockBuilder(Query::class)->getMock();
        $this->order->setQuery($queryMock);
        $this->assertEquals($this->order->getQuery(), $queryMock);
    }
}
