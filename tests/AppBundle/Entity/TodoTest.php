<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Todo;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Array_;
use PHPUnit\Framework\TestCase;

class TodoEntityTest extends TestCase
{
    /**
     * @var Todo
     */
    private $todo;
    public function setUp()
    {
        $this->todo = new Todo();
    }
    public function testConstructor()
    {
        $this->assertInstanceOf(Todo::class, $this->todo);
    }

    // public function testGetId() {
    //     $id = $this->todo->getId();
    //     $this->assertEquals($id, null);
    // }

    // public function testSetReportId() {
    //     $this->todo->setReportId("testReportIdHash");
    //     $this->assertEquals($this->todo->getReportId(), "testReportIdHash");
    // }

    // public function testSetLimit() {
    //     $this->todo->setLimit(20);
    //     $this->assertEquals($this->todo->getLimit(), 20);
    // }

    // public function testSetSortDirection() {
    //     $this->todo->setSortDirection('asc');
    //     $this->assertEquals($this->todo->getSortDirection(), 'asc');
    // }

    // public function testSetSortColumn() {
    //     $this->todo->setSortColumn('first_name');
    //     $this->assertEquals($this->todo->getSortColumn(), 'first_name');
    // }

    // public function testSetDisplayName() {
    //     $this->todo->setDisplayName('My saved search');
    //     $this->assertEquals($this->todo->getDisplayName(), 'My saved search');
    // }

    // public function testAddField() {
    //     $fieldMock = $this->getMockBuilder(Field::class)
    //         ->getMock();
    //     $this->todo->addField($fieldMock);
    //     $this->assertContains($fieldMock, $this->todo->getFields());
    // }

    // public function testSetFieldsFromArray() {
    //     $mockArray = [
    //         [
    //             "label" => "test",
    //             "value" => "test-value"
    //         ],
    //         [
    //             "label" => "test2",
    //             "value" => "test-value2"
    //         ]
    //     ];
    //     $expectedCollection = new ArrayCollection();
    //     foreach($mockArray as $mock){
    //         $mockField = new Field();
    //         $mockField->setTodo($this->todo);
    //         $mockField->setLabel($mock['label']);
    //         $mockField->setValue($mock['value']);
    //         $expectedCollection->add($mockField);
    //     }
    //     $this->todo->setFieldsFromArray($mockArray);
    //     $this->assertEquals($expectedCollection, $this->todo->getFields());
    // }

    // public function testRemoveField() {
    //     $fieldMock = $this->getMockBuilder(Field::class)
    //         ->getMock();
    //     $this->assertEmpty($this->todo->getFields());
    //     $this->todo->addField($fieldMock);
    //     $this->assertContains($fieldMock, $this->todo->getFields());
    //     $this->todo->removeField($fieldMock);
    //     $this->assertNotContains($fieldMock, $this->todo->getFields());
    // }

    // public function testAddFilter() {
    //     $filterMock = $this->getMockBuilder(Filter::class)
    //         ->getMock();
    //     $this->todo->addFilter($filterMock);
    //     $this->assertContains($filterMock, $this->todo->getFilters());
    // }

    // public function testSetFiltersFromArray() {
    //     $mockArray = [
    //         [
    //             "filter" => "testFilter1",
    //             "label" => "testLabel1",
    //             "operator" => "op1",
    //             "value" => "value1"
    //         ],
    //         [
    //             "filter" => "testFilter2",
    //             "label" => "testLabel2",
    //             "operator" => "op2",
    //             "value" => "value2"
    //         ]
    //     ];
    //     $expectedCollection = new ArrayCollection();
    //     foreach($mockArray as $filter){
    //         $filterObject = new Filter();
    //         $filterObject->setFilter($filter["filter"]);
    //         $filterObject->setLabel($filter["label"]);
    //         $filterObject->setOperator($filter["operator"]);
    //         $filterObject->setValue($filter["value"]);
    //         $filterObject->setTodo($this->todo);
    //         $expectedCollection->add($filterObject);
    //     }
    //     $this->todo->setFiltersFromArray($mockArray);
    //     $this->assertEquals($expectedCollection, $this->todo->getFilters());
    // }

    // public function testRemoveFilter() {
    //     $filterMock = $this->getMockBuilder(Filter::class)
    //         ->getMock();
    //     $this->assertEmpty($this->todo->getFilters());
    //     $this->todo->addFilter($filterMock);
    //     $this->assertContains($filterMock, $this->todo->getFilters());
    //     $this->todo->removeFilter($filterMock);
    //     $this->assertNotContains($filterMock, $this->todo->getFilters());
    // }

    // public function testAddOrder() {
    //     $orderMock = $this->getMockBuilder(Order::class)
    //         ->getMock();
    //     $this->todo->addOrder($orderMock);
    //     $this->assertContains($orderMock, $this->todo->getOrders());
    // }

    // public function testSetOrdersFromArray() {
    //     $mockArray = [
    //         [
    //             "order" => 123,
    //             "column" => "column1"
    //         ],
    //         [
    //             "order" => 234,
    //             "column" => "column2"
    //         ]
    //     ];
    //     $expectedCollection = new ArrayCollection();
    //     foreach($mockArray as $order){
    //         $orderObject = new Order();
    //         $orderObject->setOrder($order["order"]);
    //         $orderObject->setColumn($order["column"]);
    //         $orderObject->setTodo($this->todo);
    //         $expectedCollection->add($orderObject);
    //     }
    //     $this->todo->setOrdersFromArray($mockArray);
    //     $this->assertEquals($expectedCollection, $this->todo->getOrders());
    // }

    // public function testRemoveOrder() {
    //     $orderMock = $this->getMockBuilder(Order::class)
    //         ->getMock();
    //     $this->assertEmpty($this->todo->getOrders());
    //     $this->todo->addOrder($orderMock);
    //     $this->assertContains($orderMock, $this->todo->getOrders());
    //     $this->todo->removeOrder($orderMock);
    //     $this->assertNotContains($orderMock, $this->todo->getOrders());
    // }

    // public function testAddWidth() {
    //     $widthMock = $this->getMockBuilder(Width::class)
    //         ->getMock();
    //     $this->todo->addWidth($widthMock);
    //     $this->assertContains($widthMock, $this->todo->getWidths());
    // }

    // public function testSetWidthFromArray() {
    //     $mockArray = [
    //         [
    //             "width" => 100,
    //             "column" => "column1"
    //         ],
    //         [
    //             "width" => 101,
    //             "column" => "column2"
    //         ]
    //     ];
    //     $expectedCollection = new ArrayCollection();
    //     foreach($mockArray as $width){
    //         $widthObject = new Width();
    //         $widthObject->setWidth($width["width"]);
    //         $widthObject->setColumn($width["column"]);
    //         $widthObject->setTodo($this->todo);
    //         $expectedCollection->add($widthObject);
    //     }
    //     $this->todo->setWidthsFromArray($mockArray);
    //     $this->assertEquals($expectedCollection, $this->todo->getWidths());
    // }

    // public function testRemoveWidth() {
    //     $widthMock = $this->getMockBuilder(Width::class)
    //         ->getMock();
    //     $this->assertEmpty($this->todo->getWidths());
    //     $this->todo->addWidth($widthMock);
    //     $this->assertContains($widthMock, $this->todo->getWidths());
    //     $this->todo->removeWidth($widthMock);
    //     $this->assertNotContains($widthMock, $this->todo->getWidths());
    // }

    // public function testSetDisplayOrder() {
    //     $this->todo->setDisplayOrder(123);
    //     $this->assertEquals($this->todo->getDisplayOrder(), 123);
    // }

    // public function testSetFavorite() {
    //     $this->assertEquals($this->todo->isFavorite(), false);
    //     $this->todo->setFavorite(true);
    //     $this->assertEquals($this->todo->isFavorite(), true);
    // }

}