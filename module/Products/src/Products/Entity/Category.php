<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 09/11/13
 * Time: 09:40
 */
namespace Products\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
use Doctrine\Common\Collections\ArrayCollection;

class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    protected $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getId()
    {
        return $this->id;
    }
}