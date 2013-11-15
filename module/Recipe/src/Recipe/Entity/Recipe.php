<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 09/11/13
 * Time: 15:25
 */

namespace Recipe\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Recipe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="cooking_time", type="integer")
     */
    private $cooking_time;

    /**
     * @ORM\OneToMany(targetEntity="Recipe\Entity\UserRecipeAssociation", mappedBy="recipe")
     */
    protected $user_recipe_associations;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Recipe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Recipe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set cooking_time
     *
     * @param integer $cookingTime
     * @return Recipe
     */
    public function setCookingTime($cookingTime)
    {
        $this->cooking_time = $cookingTime;

        return $this;
    }

    /**
     * Get cooking_time
     *
     * @return integer
     */
    public function getCookingTime()
    {
        return $this->cooking_time;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user_recipe_associations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user_recipe_associations
     *
     * @param \Recipe\Entity\UserRecipeAssociation $userRecipeAssociations
     * @return Recipe
     */
    public function addUserRecipeAssociation(\Recipe\Entity\UserRecipeAssociation $userRecipeAssociations)
    {
        $this->user_recipe_associations[] = $userRecipeAssociations;

        return $this;
    }

    /**
     * Remove user_recipe_associations
     *
     * @param \Recipe\Entity\UserRecipeAssociation $userRecipeAssociations
     */
    public function removeUserRecipeAssociation(\Recipe\Entity\UserRecipeAssociation $userRecipeAssociations)
    {
        $this->user_recipe_associations->removeElement($userRecipeAssociations);
    }

    /**
     * Get user_recipe_associations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRecipeAssociations()
    {
        return $this->user_recipe_associations;
    }
}

?>