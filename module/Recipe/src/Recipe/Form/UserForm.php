<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 10/11/13
 * Time: 12:25
 */


namespace Recipe\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class UserForm extends Form
{

    public function __construct()
    {
        // we want to ignore the name passed
        parent::__construct('recipe');

        // cocktails
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'userName',
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

    }
}