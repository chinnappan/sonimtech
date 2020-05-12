<?php
namespace UserManagement\Form;

use Zend\Form\Form;

class ExchangeForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'exchange_id',
            'options' => array(
                'use_hidden_element' => true,
                'checked_value' => 'yes',
                'unchecked_value' => 'no'
            ),
            'attributes' => array(
                'class'  => 'form-control',
            ),
        ));
		
 

        
		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Configure Favorite',
                'id' => 'submitbutton',
                'class'  => 'btn btn-primary',
            ),
        )); 
    }
}