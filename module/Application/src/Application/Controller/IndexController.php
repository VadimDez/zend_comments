<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Entity\Category;
use Application\Entity\Product;
use Application\Entity\Recipe;
use Application\Entity\User;
use Application\Entity\UserRecipeAssociation;
use Application\Form\AddCommentForm;
use Application\Form\ApplicationForm;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class IndexController extends AbstractActionController
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


// @todo
//        mkdir data/DoctrineORMModule
//        mkdir data/DoctrineORMModule/Proxy
//        chmod 755 data/DoctrineORMModule/Proxy

//        $user = new User();
//        $recipe = new Recipe();
//        $recipe->setName("ASD");
//        $recipe->setCookingTime(123);
//        $recipe->setDescription("ASD");
//        $userRecipe = new UserRecipeAssociation();
//        $userRecipe->setUser( $user );
//        $userRecipe->setRecipe( $recipe);
//        $em = $this->getEntityManager();
//        $em->persist( $user );
//        $em->flush();
//        $em->persist( $recipe );
//        $em->flush();
//        $em->persist( $userRecipe);
//        $em->flush();



//        $id = 1;
//        $product = $this->getEntityManager()
//            ->getRepository('Application\Entity\Product')
//            ->findAll();
//
//        $category = $this->getEntityManager()
//            ->getRepository('Application\Entity\Category')
//            ->findAll();
//
//        $products = array();
//        foreach($category as $categ)
//        {
//            foreach($categ->getProducts() as $prod)
//            array_push($products,$prod);
//        }
//
//        // searching by id
//        try
//        {
//            $test = $this->getEntityManager()
//                ->getRepository('Application\Entity\Product')
//                ->findOneById(1);
//            //var_dump($test->getName() . '<br/>');
//        }
//        catch(\Exception $e)
//        {
//
//        }
//
//
//
//        // searching by name
//        $test = $this->getEntityManager()
//            ->getRepository('Application\Entity\Product')
//            ->findOneByName('Foo');
//        //var_dump($test->getId() . '<br/>');
//
//        // searching with parameters
//        $test = $this->getEntityManager()
//            ->getRepository('Application\Entity\Product')
//            ->findBy(array(
//                'name' => 'Foo'
//            ));
//        foreach($test as $tst)
//        {
//            //var_dump($tst->getId());
//        }
//
//        //
//        $product = $this->getEntityManager()
//            ->getRepository('Application\Entity\Product')
//            ->find(1);

        //var_dump('aasd:' . $product->getCategory()->getName());





        //
        // insert
//        $category = new Category();
//        $category->setName('Main Products');
//
//        $product = new Product();
//        $product->setName('Foo');
//        // relate this product to the category
//        $product->setCategory($category);
//
//        $em = $this->getEntityManager();
//        $em->persist($category);
//        $em->persist($product);
//        $em->flush();



        // Retrieve an instance of the Entity Manager
//        $qb = $this->getEntityManager()->createQueryBuilder();
//
//        $qb->select('u')
//            ->from('Application\Entity\User', 'u');
//
//        $query = $qb->getQuery();
//        $query->useResultCache(TRUE);
//        $result = $query->getResult();









        //$repository = $this->getDoctrine()->getRepository('\Application\Entity\Comment');
//        $em = $this->getEntityManager();
//
//        $query = $em->createQuery(
//            'SELECT DISTINCT d
//            FROM AcmeDocumentBundle:Document d
//            INNER JOIN d.documentGruppen dg
//            INNER JOIN d.userGruppen ug
//            WHERE ug.userId =9
//            '
//        );
//
//        //$query = $em->createQuery('SELECT * FROM \Application\Entity\Comment as c, \Application\Entity\User as u WHERE c.idSender=u.id');
//
//        $results = $query->getResult();

        //$comments = $this->getObjectManager()->getRepository('\Application\Entity\Comment')->findAll();
        //$commented= $this->getObjectManager()->getRepository('\Application\Entity\Commented')->findAll();






        $formComment = new AddCommentForm();

        return new ViewModel(/*array(
            'comments' => $result,
            'commented'=> $commented
        )*/
//        array(
//            'product' => $product,
//            'products'=> $products,
//            'category'=> $category
//        )
        array(
            'addComment' => $formComment,
        )
        );
    }

    public function addAction()
    {
        if($this->request->isPost())
        {
            $user = new User();
            $user->setFullName($this->getRequest()->getPost('fullname'));

            $this->getObjectManager()->persist($user);
            $this->getObjectManager()->flush();

            return $this->redirect()->toRoute('home');
        }
        return new ViewModel();
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
