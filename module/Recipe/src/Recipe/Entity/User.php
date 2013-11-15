<?php
///**
// * Created by PhpStorm.
// * User: vadimdez
// * Date: 07/11/13
// * Time: 20:34
// */
//
//namespace Recipe\Entity;
//use Doctrine\ORM\Mapping as ORM;
//use Doctrine\Common\Collections\ArrayCollection;
///** @ORM\Entity */
//class User
//{
//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     * @ORM\Column(type="integer")
//     * @ORM\OneToMany(targetEntity="Comment", mappedBy="id")
//     */
//    protected $id;
//
//    /** @ORM\Column(type="string") */
//    protected $fullName;
//
//
//    public function __construct()
//    {
//        $this->comments = new ArrayCollection();
//    }
//
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    public function getFullName()
//    {
//        return $this->fullName;
//    }
//
//    public function setFullName($value)
//    {
//        $this->fullName = $value;
//    }
//}
//
//

    namespace Recipe\Entity;

    use Doctrine\ORM\Mapping as ORM;

    /**
    * @ORM\Entity
    * @ORM\Table(name="User")
    */
    class User
    {
        /**
        * @ORM\Id
        * @ORM\Column(type="integer")
        * @ORM\GeneratedValue(strategy="AUTO")
        */
        protected $id;

        /**
         * @ORM\Column(type="string")
         */
        protected $name;

        /**
        * @ORM\OneToMany(targetEntity="UserRecipeAssociation", mappedBy="user")
        */
        protected $user_recipe_associations;

        public function __construct()
        {

            $this->user_recipe_associations = new \Doctrine\Common\Collections\ArrayCollection();
        }

        /**
        * Get id
        *
        * @return integer
        */
        public function getId()
        {
            return $this->id;
        }

        public function setName($name)
        {
            $this->name = $name;
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
        * Add user_recipe_associations
        *
        * @param \Recipe\Entity\UserRecipeAssociation $userRecipeAssociations
        * @return User
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