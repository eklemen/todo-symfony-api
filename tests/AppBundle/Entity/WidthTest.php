<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Width;
use AppBundle\Entity\Query;
use PHPUnit\Framework\TestCase;

class WidthEntityTest extends TestCase
{
    private $width;
    public function setUp()
    {
        $this->width = new Width();
    }
    public function testConstructor()
    {
        $this->assertInstanceOf(Width::class, $this->width);
    }

    public function testGetId() {
        $id = $this->width->getId();
        $this->assertEquals($id, null);
    }

    public function testGetSetWidth() {
        $this->width->setWidth(123);
        $this->assertEquals($this->width->getWidth(), 123);
    }

    public function testGetSetColumn() {
        $this->width->setColumn("testColumn");
        $this->assertEquals($this->width->getColumn(), "testColumn");
    }


    public function testGetSetQuery() {
        $queryMock = $this->getMockBuilder(Query::class)->getMock();
        $this->width->setQuery($queryMock);
        $this->assertEquals($this->width->getQuery(), $queryMock);
    }
}
