<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 10/11/13
 * Time: 10:34
 */


namespace Recipe\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class RecipeForm extends Form
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
            'name' => 'description',
            'options' => array(
                'label' => 'Description:',
            ),
        ));

        $this->add(array(
            'name' => 'recipeName',
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
            'name' => 'time',
            'type' => 'Text',
            'options' => array(
                'label' => 'Time:',
            ),
        ));

        $this->add(array(
            'name'    => 'idUser',
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
        $users = $this->em
            ->getRepository('Recipe\Entity\User')
            ->findAll();

        $selectData = array();

        foreach ($users as $user) {
            $selectData[$user->getId()] = $user->getName();
        }

        return $selectData;
    }
}