<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 10/11/13
 * Time: 10:17
 */

namespace Products\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class ProductsForm extends Form
{

    private $em;
    public function __construct($em)
    {
        $this->em = $em;
        // we want to ignore the name passed
        parent::__construct('comments');

        // cocktails
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'text',
            'options' => array(
                'label' => 'text',
            ),
        ));

        $this->add(array(
            'name' => 'productName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Send',
                'id' => 'submitbutton',
            ),
        ));

        $this->add(array(
            'name'    => 'idCategory',
            'type'    => 'Zend\Form\Element\Select',
            'options' => array(
                'label'         => 'Category',
                'value_options' => $this->getOptionsForSelect(),
                'empty_option'  => '--- please choose ---'
            )
        ));
    }

    public function getOptionsForSelect()
    {
        $categories = $this->em
            ->getRepository('Products\Entity\Category')
            ->findAll();

        $selectData = array();

        foreach ($categories as $category) {
            $selectData[$category->getId()] = $category->getName();
        }

        return $selectData;
    }
}