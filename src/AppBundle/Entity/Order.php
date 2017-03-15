<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="`order`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 */
class Order
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
     * @ORM\Column(name="`column`", type="string", length=100)
     */
    private $column;

    /**
     * @var int
     *
     * @ORM\Column(name="`order`", type="integer")
     */
    private $order;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Query", inversedBy="orders")
     * @ORM\JoinColumn(name="query_id", referencedColumnName="id")
     */
    private $query;


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
     * Set column
     *
     * @param string $column
     *
     * @return Column
     */
    public function setColumn($column)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Get column
     *
     * @return string
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set order
     *
     * @param int $order
     * @return Order
     */
    public function setOrder(int $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get columnOrder
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set query
     *
     * @param \AppBundle\Entity\Query $query
     *
     * @return Order
     */
    public function setQuery(Query $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get query
     *
     * @return \AppBundle\Entity\Query
     */
    public function getQuery()
    {
        return $this->query;
    }
}

