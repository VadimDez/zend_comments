<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 09/11/13
 * Time: 17:22
 */


namespace Comments\Form;
use Zend\Form\Form;
use Zend\Form\Element;

class AddCommentForm extends Form
{

    public function __construct()
    {
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
            'name' => 'senderName',
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