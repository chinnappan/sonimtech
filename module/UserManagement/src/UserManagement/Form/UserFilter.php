<?php
namespace UserManagement\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter
{
	public function __construct()
	{
		// self::__construct(); // parnt::__construct(); - trows and error
		//$this->setAttribute('enctype','multipart/form-data');
		$this->add(array(
			'name'     => 'user_name',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 1,
						'max'      => 100,
					),
				),
			),
		));

        $this->add(array(
            'name'       => 'user_email',
            'required'   => true,
            'validators' => array(
                array(
                    'name' => 'EmailAddress'
                ),
            ),
        ));
		
		$this->add(array(
			'name'     => 'user_phone',
			'required' => true,
			'filters'  => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
		
			),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min'      => 10,
						'max'      => 10,
					),
				),
			),
		));
	
	}
}