<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 09/11/13
 * Time: 17:53
 */

namespace Comments\Controller;


use Comments\Entity\Message;
use Comments\Form\AddCommentForm;
use Comments\Model\Comments;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Client;
class CommentsController extends AbstractActionController
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

        $messages = $this->getEntityManager()
            ->getRepository('Comments\Entity\Message')
            ->findAll();

        $formComment = new AddCommentForm();

        return new ViewModel(array(
                'addComment' => $formComment,
                'messages'   => $messages
            )
        );
    }

    public function addAction()
    {
        $form = new AddCommentForm();
        $request = $this->getRequest();
        if($request->isPost())
        {
            $comments = new Comments();
            $form->setInputFilter($comments->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $message = new Message();

                $id = (int)$this->params()->fromRoute('id',0);
                if($id!=0)
                {
                    $parent = $this->getObjectManager()
                        ->getRepository('Comments\Entity\Message')
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
        return $this->redirect()->toRoute('comments');
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
