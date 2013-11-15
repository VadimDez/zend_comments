<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 09/11/13
 * Time: 09:17
 */

namespace Comments\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $senderName;

    /** @ORM\Column(type="string") */
    protected $text;

    /**
     * @ORM\ManyToOne(targetEntity="Message", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parent = null;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="parent")
     */
    private $children;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSenderName($name)
    {
        $this->senderName = $name;
    }

    public function getSenderName()
    {
        return $this->senderName;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

}