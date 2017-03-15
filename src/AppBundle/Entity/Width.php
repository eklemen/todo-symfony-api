<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Width
 *
 * @ORM\Table(name="width")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WidthRepository")
 */
class Width
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
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var \AppBundle\Entity\Query
     *
     * @ORM\ManyToOne(targetEntity="Query", inversedBy="widths")
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
     * @return Width
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
     * Set width
     *
     * @param integer $width
     *
     * @return Width
     */
    public function setWidth(int $width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set query
     *
     * @param \AppBundle\Entity\Query
     *
     * @return Width
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

