<?php
namespace UserManagement\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');


		
       $this->add(array(
            'name' => 'user_email',
            'attributes' => array(
                'type'  => 'email',
                'class'  => 'form-control',
            ),
            'options' => array(
                'label' => 'E-mail',
            ),
        ));	

        $this->add(array(
            'name' => 'user_password',
            'attributes' => array(
                'type'  => 'password',
                'class'  => 'form-control',
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Login',
                'id' => 'submitbutton',
                'class'  => 'btn btn-primary',
            ),
        )); 
    }
}