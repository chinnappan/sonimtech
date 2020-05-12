<?php
namespace UserManagement\Form;

use Zend\Form\Form;

class UserForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');
        $this->add(array(
            'name' => 'user_name',
            'attributes' => array(
                'type'  => 'text',
                'class'  => 'form-control',
            ),
            'options' => array(
                'label' => 'Username',
            ),
        ));
		
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
            'type' => 'Zend\Form\Element\File',
            'name' => 'user_picture',
            'options' => array(
                 'label' => 'Attachment:'
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));

        
        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'user_gender',
            'options' => array(
                'label' => 'What is your gender ?',
                'value_options' => array(
                    '0' => 'Female',
                    '1' => 'Male',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'user_phone',
            'attributes' => array(
                'type'  => 'text',
                'class'  => 'form-control',
            ),
            'options' => array(
                'label' => 'Phone Number',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Register',
                'id' => 'submitbutton',
                'class'  => 'btn btn-primary',
            ),
        )); 
    }
}