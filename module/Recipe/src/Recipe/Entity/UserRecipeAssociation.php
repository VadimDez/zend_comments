<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 09/11/13
 * Time: 15:27
 */

namespace Recipe\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRecipeAssociation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserRecipeAssociation
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
     **/

    /**
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user_recipe_associations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="\Recipe\Entity\Recipe", inversedBy="user_recipe_associations")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    private $recipe;

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
     * Set user
     *
     * @param \Recipe\Entity\User $user
     * @return UserRecipeAssociation
     */
    public function setUser(\Recipe\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Recipe\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set recipe
     *
     * @param \Recipe\Entity\Recipe $recipe
     * @return UserRecipeAssociation
     */
    public function setRecipe(\Recipe\Entity\Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \Recipe\Entity\Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}