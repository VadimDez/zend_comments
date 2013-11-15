<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 09/11/13
 * Time: 11:10
 */


namespace Application\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class ApplicationForm extends Form
{

    public function __construct()
    {
        // we want to ignore the name passed
        parent::__construct('application');

        // cocktails
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'productName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
            'name' => 'categoryName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Category name',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

        $this->add(array(
            'name' => 'categoryId',
            'type' => 'Text',
            'options' => array(
                'label' => 'categoryId',
            ),
        ));


    }


}