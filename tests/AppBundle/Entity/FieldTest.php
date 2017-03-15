<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Field;
use AppBundle\Entity\Query;
use PHPUnit\Framework\TestCase;

class FieldEntityTest extends TestCase
{
    /**
     * @var AppBundle/Entity/Field
     */
    private $field;
    public function setUp()
    {
        $this->field = new Field();
    }
    public function testConstructor()
    {
        $this->assertInstanceOf(Field::class, $this->field);
    }

    public function testGetId() {
        $id = $this->field->getId();
        $this->assertEquals($id, null);
    }

    public function testGetSetLabel() {
        $this->field->setLabel("testLabel");
        $this->assertEquals($this->field->getLabel(), "testLabel");
    }

    public function testGetSetValue() {
        $this->field->setValue("testValue");
        $this->assertEquals($this->field->getValue(), "testValue");
    }

    public function testGetSetType() {
        $this->field->setType("testType");
        $this->assertEquals($this->field->getType(), "testType");
    }

    public function testGetSetQuery() {
        $queryMock = $this->getMockBuilder(Query::class)->getMock();
        $this->field->setQuery($queryMock);
        $this->assertEquals($this->field->getQuery(), $queryMock);
    }
}
