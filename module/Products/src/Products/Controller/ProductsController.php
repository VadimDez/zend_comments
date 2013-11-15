<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 10/11/13
 * Time: 10:11
 */


namespace Products\Controller;


use Doctrine\ORM\EntityManager;
use Products\Entity\Category;
use Products\Entity\Product;
use Products\Form\CategoryForm;
use Products\Form\ProductsForm;
use Products\Model\Products;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProductsController extends AbstractActionController
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
        $categories = $this->getEntityManager()
            ->getRepository('Products\Entity\Category')
            ->findAll();

        $products = $this->getEntityManager()
            ->getRepository('Products\Entity\Product')
            ->findAll();

        return new ViewModel(array(
            'categories' => $categories,
            'products'   => $products
        ));
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
        $em = $this->getObjectManager();
        $form = new ProductsForm($em);

        $request = $this->getRequest();
        if($request->isPost())
        {
            $category = new Products();
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid())
            {

                $product = new Product();
                $product->setName($request->getPost('productName'));
                $category = $this->getObjectManager()
                    ->getRepository('Products\Entity\Category')
                    ->findOneById((int)$request->getPost('idCategory'));
                $product->setCategory($category);
                $em->persist($product);
                $em->flush();
            }
            return $this->redirect()->toRoute('products');
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function createcategoryAction()
    {
        $form = new CategoryForm();

        $request = $this->getRequest();
        if($request->isPost())
        {
            $category = new Products();
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid())
            {
                $category = new Category();
                $category->setName($request->getPost('categoryName'));
                $em = $this->getObjectManager();
                $em->persist($category);
                $em->flush();

            }
            return $this->redirect()->toRoute('products');
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }


}
