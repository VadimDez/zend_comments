<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 10/11/13
 * Time: 10:56
 */

namespace Products\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class CategoryForm extends Form
{

    public function __construct()
    {
        // we want to ignore the name passed
        parent::__construct('products');

        // cocktails
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
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
                'value' => 'Send',
                'id' => 'submitbutton',
            ),
        ));

    }
}