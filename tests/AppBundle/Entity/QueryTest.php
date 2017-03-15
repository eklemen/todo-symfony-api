<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Query;
use AppBundle\Entity\Field;
use AppBundle\Entity\Filter;
use AppBundle\Entity\Order;
use AppBundle\Entity\Width;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Array_;
use PHPUnit\Framework\TestCase;

class QueryEntityTest extends TestCase
{
    /**
     * @var Query
     */
    private $query;
    public function setUp()
    {
        $this->query = new Query();
    }
    public function testConstructor()
    {
        $this->assertInstanceOf(Query::class, $this->query);
    }

    public function testGetId() {
        $id = $this->query->getId();
        $this->assertEquals($id, null);
    }

    public function testSetReportId() {
        $this->query->setReportId("testReportIdHash");
        $this->assertEquals($this->query->getReportId(), "testReportIdHash");
    }

    public function testSetLimit() {
        $this->query->setLimit(20);
        $this->assertEquals($this->query->getLimit(), 20);
    }

    public function testSetSortDirection() {
        $this->query->setSortDirection('asc');
        $this->assertEquals($this->query->getSortDirection(), 'asc');
    }

    public function testSetSortColumn() {
        $this->query->setSortColumn('first_name');
        $this->assertEquals($this->query->getSortColumn(), 'first_name');
    }

    public function testSetDisplayName() {
        $this->query->setDisplayName('My saved search');
        $this->assertEquals($this->query->getDisplayName(), 'My saved search');
    }

    public function testAddField() {
        $fieldMock = $this->getMockBuilder(Field::class)
            ->getMock();
        $this->query->addField($fieldMock);
        $this->assertContains($fieldMock, $this->query->getFields());
    }

    public function testSetFieldsFromArray() {
        $mockArray = [
            [
                "label" => "test",
                "value" => "test-value"
            ],
            [
                "label" => "test2",
                "value" => "test-value2"
            ]
        ];
        $expectedCollection = new ArrayCollection();
        foreach($mockArray as $mock){
            $mockField = new Field();
            $mockField->setQuery($this->query);
            $mockField->setLabel($mock['label']);
            $mockField->setValue($mock['value']);
            $expectedCollection->add($mockField);
        }
        $this->query->setFieldsFromArray($mockArray);
        $this->assertEquals($expectedCollection, $this->query->getFields());
    }

    public function testRemoveField() {
        $fieldMock = $this->getMockBuilder(Field::class)
            ->getMock();
        $this->assertEmpty($this->query->getFields());
        $this->query->addField($fieldMock);
        $this->assertContains($fieldMock, $this->query->getFields());
        $this->query->removeField($fieldMock);
        $this->assertNotContains($fieldMock, $this->query->getFields());
    }

    public function testAddFilter() {
        $filterMock = $this->getMockBuilder(Filter::class)
            ->getMock();
        $this->query->addFilter($filterMock);
        $this->assertContains($filterMock, $this->query->getFilters());
    }

    public function testSetFiltersFromArray() {
        $mockArray = [
            [
                "filter" => "testFilter1",
                "label" => "testLabel1",
                "operator" => "op1",
                "value" => "value1"
            ],
            [
                "filter" => "testFilter2",
                "label" => "testLabel2",
                "operator" => "op2",
                "value" => "value2"
            ]
        ];
        $expectedCollection = new ArrayCollection();
        foreach($mockArray as $filter){
            $filterObject = new Filter();
            $filterObject->setFilter($filter["filter"]);
            $filterObject->setLabel($filter["label"]);
            $filterObject->setOperator($filter["operator"]);
            $filterObject->setValue($filter["value"]);
            $filterObject->setQuery($this->query);
            $expectedCollection->add($filterObject);
        }
        $this->query->setFiltersFromArray($mockArray);
        $this->assertEquals($expectedCollection, $this->query->getFilters());
    }

    public function testRemoveFilter() {
        $filterMock = $this->getMockBuilder(Filter::class)
            ->getMock();
        $this->assertEmpty($this->query->getFilters());
        $this->query->addFilter($filterMock);
        $this->assertContains($filterMock, $this->query->getFilters());
        $this->query->removeFilter($filterMock);
        $this->assertNotContains($filterMock, $this->query->getFilters());
    }

    public function testAddOrder() {
        $orderMock = $this->getMockBuilder(Order::class)
            ->getMock();
        $this->query->addOrder($orderMock);
        $this->assertContains($orderMock, $this->query->getOrders());
    }

    public function testSetOrdersFromArray() {
        $mockArray = [
            [
                "order" => 123,
                "column" => "column1"
            ],
            [
                "order" => 234,
                "column" => "column2"
            ]
        ];
        $expectedCollection = new ArrayCollection();
        foreach($mockArray as $order){
            $orderObject = new Order();
            $orderObject->setOrder($order["order"]);
            $orderObject->setColumn($order["column"]);
            $orderObject->setQuery($this->query);
            $expectedCollection->add($orderObject);
        }
        $this->query->setOrdersFromArray($mockArray);
        $this->assertEquals($expectedCollection, $this->query->getOrders());
    }

    public function testRemoveOrder() {
        $orderMock = $this->getMockBuilder(Order::class)
            ->getMock();
        $this->assertEmpty($this->query->getOrders());
        $this->query->addOrder($orderMock);
        $this->assertContains($orderMock, $this->query->getOrders());
        $this->query->removeOrder($orderMock);
        $this->assertNotContains($orderMock, $this->query->getOrders());
    }

    public function testAddWidth() {
        $widthMock = $this->getMockBuilder(Width::class)
            ->getMock();
        $this->query->addWidth($widthMock);
        $this->assertContains($widthMock, $this->query->getWidths());
    }

    public function testSetWidthFromArray() {
        $mockArray = [
            [
                "width" => 100,
                "column" => "column1"
            ],
            [
                "width" => 101,
                "column" => "column2"
            ]
        ];
        $expectedCollection = new ArrayCollection();
        foreach($mockArray as $width){
            $widthObject = new Width();
            $widthObject->setWidth($width["width"]);
            $widthObject->setColumn($width["column"]);
            $widthObject->setQuery($this->query);
            $expectedCollection->add($widthObject);
        }
        $this->query->setWidthsFromArray($mockArray);
        $this->assertEquals($expectedCollection, $this->query->getWidths());
    }

    public function testRemoveWidth() {
        $widthMock = $this->getMockBuilder(Width::class)
            ->getMock();
        $this->assertEmpty($this->query->getWidths());
        $this->query->addWidth($widthMock);
        $this->assertContains($widthMock, $this->query->getWidths());
        $this->query->removeWidth($widthMock);
        $this->assertNotContains($widthMock, $this->query->getWidths());
    }

    public function testSetDisplayOrder() {
        $this->query->setDisplayOrder(123);
        $this->assertEquals($this->query->getDisplayOrder(), 123);
    }

    public function testSetFavorite() {
        $this->assertEquals($this->query->isFavorite(), false);
        $this->query->setFavorite(true);
        $this->assertEquals($this->query->isFavorite(), true);
    }

}