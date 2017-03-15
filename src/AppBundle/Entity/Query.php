<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use AppBundle\Entity\Field;
use AppBundle\Entity\Filter;
use AppBundle\Entity\Order;
use AppBundle\Entity\Width;

/**
 * Query
 *
 * @ORM\Table(name="query")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QueryRepository")
 */
class Query
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="report_id", type="string", length=100)
     */
    private $reportId;

    /**
     * @var int
     *
     * @ORM\Column(name="`limit`", type="integer")
     */
    private $limit;

    /**
     * @var string
     *
     * @ORM\Column(name="sort_direction", type="string", length=100, nullable=true)
     */
    private $sortDirection;

    /**
     * @var string
     *
     * @ORM\Column(name="sort_column", type="string", length=100, nullable=true)
     */
    private $sortColumn;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=100)
     */
    private $displayName;

    /**
     * @var ArrayCollection<Field>
     * @ORM\OneToMany(targetEntity="Field", mappedBy="query", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $fields;

    /**
     * @var ArrayCollection<Filter>
     * @ORM\OneToMany(targetEntity="Filter", mappedBy="query", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $filters;

    /**
     * @var ArrayCollection<Order>
     * @ORM\OneToMany(targetEntity="Order", mappedBy="query", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $orders;

    /**
     * @var ArrayCollection<Width>
     * @ORM\OneToMany(targetEntity="Width", mappedBy="query", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $widths;

    /**
     * @var boolean
     *
     * @ORM\Column(name="favorite", type="boolean", nullable=false, options={"default": false})
     */
    private $favorite;

    /**
     * @var int
     *
     * @ORM\Column(name="display_order", type="integer", nullable=true)
     */
    private $displayOrder;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
        $this->filters = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->widths = new ArrayCollection();
        $this->favorite = false;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reportId
     *
     * @param string $reportId
     *
     * @return Query
     */
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;

        return $this;
    }

    /**
     * Get reportId
     *
     * @return string
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * Set limit
     *
     * @param string $limit
     *
     * @return Query
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Get limit
     *
     * @return string
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set sortDirection
     *
     * @param string $sortDirection
     *
     * @return Query
     */
    public function setSortDirection($sortDirection)
    {
        $this->sortDirection = $sortDirection;

        return $this;
    }

    /**
     * Get sortDirection
     *
     * @return string
     */
    public function getSortDirection()
    {
        return $this->sortDirection;
    }

    /**
     * Set sortColumn
     *
     * @param string $sortColumn
     *
     * @return Query
     */
    public function setSortColumn($sortColumn)
    {
        $this->sortColumn = $sortColumn;

        return $this;
    }

    /**
     * Get sortColumn
     *
     * @return string
     */
    public function getSortColumn()
    {
        return $this->sortColumn;
    }


    /**
     * Set displayName
     *
     * @param string $displayName
     *
     * @return Query
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Add field
     *
     * @param Field $field
     *
     * @return Query
     */
    public function addField(Field $field)
    {
        $field->setQuery($this);
        $this->fields->add($field);

        return $this;
    }

    /**
     * @param array $fields
     */
    public function setFieldsFromArray(array $fields)
    {
        $this->fields->clear();
        foreach($fields as $field){
            $fieldObject = new Field();
            isset($field["label"]) && $fieldObject->setLabel($field["label"]);
            isset($field["value"]) && $fieldObject->setValue($field["value"]);
            $this->addField($fieldObject);
        }
    }

    /**
     * Remove field
     *
     * @param Field $field
     */
    public function removeField(Field $field)
    {
        $this->fields->removeElement($field);
    }

    /**
     * Get fields
     *
     * @return Collection
     */
    public function getFields()
    {
        return $this->fields;
    }


    /**
     * Add filter
     *
     * @param Filter $filter
     *
     * @return Query
     */
    public function addFilter(Filter $filter)
    {
        $filter->setQuery($this);
        $this->filters->add($filter);

        return $this;
    }

    /**
     * @param array $filters
     */
    public function setFiltersFromArray(array $filters)
    {
        $this->filters->clear();
        foreach($filters as $filter){
            $filterObject = new Filter();
            isset($filter["filter"]) && $filterObject->setFilter($filter["filter"]);
            isset($filter["label"]) && $filterObject->setLabel($filter["label"]);
            isset($filter["operator"]) && $filterObject->setOperator($filter["operator"]);
            isset($filter["value"]) && $filterObject->setValue($filter["value"]);
            $this->addFilter($filterObject);
        }
    }

    /**
     * Remove filter
     *
     * @param Filter $filter
     */
    public function removeFilter(Filter $filter)
    {
        $this->filters->removeElement($filter);
    }

    /**
     * Get filters
     *
     * @return Collection
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Add order
     *
     * @param Order $order
     *
     * @return Query
     */
    public function addOrder(Order $order)
    {
        $order->setQuery($this);
        $this->orders->add($order);

        return $this;
    }

    /**
     * @param array $orders
     */
    public function setOrdersFromArray(array $orders)
    {
        $this->orders->clear();
        foreach($orders as $order){
            $orderObject = new Order();
            isset($order["order"]) && $orderObject->setOrder($order["order"]);
            isset($order["column"]) && $orderObject->setColumn($order["column"]);
            $this->addOrder($orderObject);
        }
    }

    /**
     * Remove order
     *
     * @param Order $order
     */
    public function removeOrder(Order $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * Get orders
     *
     * @return Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Add width
     *
     * @param Width $width
     *
     * @return Query
     */
    public function addWidth(Width $width)
    {
        $width->setQuery($this);
        $this->widths->add($width);

        return $this;
    }

    /**
     * @param array $widths
     */
    public function setWidthsFromArray(array $widths)
    {
        $this->widths->clear();
        foreach($widths as $width){
            $widthObject = new Width();
            isset($width["width"]) && $widthObject->setWidth($width["width"]);
            isset($width["column"]) && $widthObject->setColumn($width["column"]);
            $this->addWidth($widthObject);
        }
    }

    /**
     * Remove width
     *
     * @param Width $width
     */
    public function removeWidth(Width $width)
    {
        $this->widths->removeElement($width);
    }

    /**
     * Get widths
     *
     * @return Collection
     */
    public function getWidths()
    {
        return $this->widths;
    }

    /**
     * @return int
     */
    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    /**
     * @param int $displayOrder
     */
    public function setDisplayOrder(int $displayOrder)
    {
        $this->displayOrder = $displayOrder;
    }


    /**
     * @return bool
     */
    public function isFavorite(): bool
    {
        return $this->favorite;
    }

    /**
     * @param bool $favorite
     */
    public function setFavorite(bool $favorite)
    {
        $this->favorite = $favorite;
    }
}
