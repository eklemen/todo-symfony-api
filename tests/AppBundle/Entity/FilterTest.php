<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Filter;
use AppBundle\Entity\Query;
use PHPUnit\Framework\TestCase;

class FilterEntityTest extends TestCase
{
    /**
     * @var Filter
     */
    private $filter;
    public function setUp()
    {
        $this->filter = new Filter();
    }
    public function testConstructor()
    {
        $this->assertInstanceOf(Filter::class, $this->filter);
    }

    public function testGetId() {
        $id = $this->filter->getId();
        $this->assertEquals($id, null);
    }

    public function testGetSetFilter() {
        $this->filter->setFilter("testFilter");
        $this->assertEquals($this->filter->getFilter(), "testFilter");
    }

    public function testGetSetLabel() {
        $this->filter->setLabel("testLabel");
        $this->assertEquals($this->filter->getLabel(), "testLabel");
    }

    public function testGetSetOperator() {
        $this->filter->setOperator("testOperator");
        $this->assertEquals($this->filter->getOperator(), "testOperator");
    }

    public function testGetSetValue() {
        $this->filter->setValue("testValue");
        $this->assertEquals($this->filter->getValue(), "testValue");
    }

    public function testGetSetQuery() {
        $queryMock = $this->getMockBuilder(Query::class)->getMock();
        $this->filter->setQuery($queryMock);
        $this->assertEquals($this->filter->getQuery(), $queryMock);
    }
}
