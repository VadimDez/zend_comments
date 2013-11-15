<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 10/11/13
 * Time: 10:32
 */



namespace Recipe\Controller;


use Doctrine\ORM\EntityManager;
use Recipe\Entity\Recipe;
use Recipe\Entity\User;
use Recipe\Entity\UserRecipeAssociation;
use Recipe\Form\RecipeForm;
use Recipe\Form\UserForm;
use Recipe\Model\RecipeModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RecipeController extends AbstractActionController
{
    protected $_objectManager;

    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        $users = $this->getEntityManager()
            ->getRepository('Recipe\Entity\User')
            ->findAll();

        $recipes = $this->getEntityManager()
            ->getRepository('Recipe\Entity\Recipe')
            ->findAll();

        $assocs  = $this->getEntityManager()
            ->getRepository('Recipe\Entity\UserRecipeAssociation')
            ->findAll();

        return new ViewModel(array(
            'users'     => $users,
            'recipes'   => $recipes,
            'assocs'    => $assocs
        ));
    }

    public function adduserAction()
    {
        $form = new UserForm();

        $request = $this->getRequest();
        if($request->isPost())
        {
            $recipe = new RecipeModel();
            $form->setInputFilter($recipe->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid())
            {
                $user = new User();
                $user->setName($request->getPost('userName'));
                $em = $this->getObjectManager();
                $em->persist($user);
                $em->flush();
                return $this->redirect()->toRoute('recipe');
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function addrecipeAction()
    {
        $em = $this->getObjectManager();
        $form = new RecipeForm($em);

        $request = $this->getRequest();
        if($request->isPost())
        {
            $recipe = new RecipeModel();
            $form->setInputFilter($recipe->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid())
            {
                // recipe
                $recipe = new Recipe();
                $recipe->setName($request->getPost('recipeName'));
                $recipe->setCookingTime((int)$request->getPost('time'));
                $recipe->setDescription($request->getPost('description'));

                // user
                $user = new User();
                $user = $this->getEntityManager()->getRepository('Recipe\Entity\User')->findOneById($request->getPost('idUser'));

                // user-recipe-assoc
                $userRecipeAssoc = new UserRecipeAssociation();
                $userRecipeAssoc->setRecipe($recipe);
                $userRecipeAssoc->setUser($user);

                $em->persist($recipe);
                $em->flush();

                $em->persist($userRecipeAssoc);
                $em->flush();
                return $this->redirect()->toRoute('recipe');
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function addAction()
    {
        $form = new AddCommentForm();
        $request = $this->getRequest();
        if($request->isPost())
        {
            $recipe = new Recipe();
            $form->setInputFilter($recipe->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $message = new Message();

                $id = (int)$this->params()->fromRoute('id',0);
                if($id!=0)
                {
                    $parent = $this->getObjectManager()
                        ->getRepository('Recipe\Entity\Message')
                        ->findOneById($id);
                    $message->setParent($parent);
                }

                $message->setSenderName($request->getPost('senderName'));
                $message->setText($request->getPost('text'));
                $em = $this->getEntityManager();
                $em->persist($message);
                $em->flush();
            }
        }
        return $this->redirect()->toRoute('recipe');
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id',0);
        $user = $this->getObjectManager()->find('\Application\Entity\User',$id);

        if ($this->request->isPost()) {
            $user->setFullName($this->getRequest()->getPost('fullname'));

            $this->getObjectManager()->persist($user);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(array('user' => $user));
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $user = $this->getObjectManager()->find('\Application\Entity\User', $id);

        if ($this->request->isPost()) {
            $this->getObjectManager()->remove($user);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(array('user' => $user));
    }

    public function createproductAction()
    {
        $form = new ApplicationForm();

        if($this->request->isPost())
        {

            $product = new Product();
            $product->setName($this->getRequest()->getPost('productName'));
            $category = $this->getEntityManager()
                ->getRepository('Application\Entity\Category')
                ->find($this->getRequest()->getPost('categoryId'));
            $product->setCategory($category);

            $em = $this->getObjectManager();
            $em->persist($product);
            $em->flush();

            return $this->redirect()->toRoute('home');
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function createcategoryAction()
    {
        $form = new ApplicationForm();

        if($this->request->isPost())
        {

            $category = new Category();
            $category->setName($this->getRequest()->getPost('categoryName'));


            $em = $this->getObjectManager();
            $em->persist($category);
            $em->flush();

            return $this->redirect()->toRoute('home');
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }


}
