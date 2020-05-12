<?php
return array(
	'controllers' => array(
        'invokables' => array(
            'UserManagement\Controller\User' => 'UserManagement\Controller\UserController',
            ),
	),
    'router' => array(
        'routes' => array(
			'user_management' => array(
				'type'    => 'Literal',
				'options' => array(
					'route'    => '/user-management',
					'defaults' => array(
						'__NAMESPACE__' => 'UserManagement\Controller',
						'controller'    => 'User',
						'action'        => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/[:controller[/:action[/:id]]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
								'id'     	 => '[0-9]*',
							),
							'defaults' => array(
							),
						),
					),
					'paginator' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/:controller/[page/:page]',
							'constraints' => array(
								'page' => '[0-9]*',
							),
							'defaults' => array(
								'__NAMESPACE__' => 'UserManagement\Controller',
								'controller'    => 'UserPaginator',
								'action'        => 'index',
							),
						),
					),
					'paginator-doctrine' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/[page/:page]',
							'constraints' => array(
								'page' => '[0-9]*',
							),
							'defaults' => array(
								'__NAMESPACE__' => 'UserManagement\Controller',
								'controller'    => 'UserDoctrinePaginator',
								'action'        => 'index',
							),
						),
					),
				),
			),			
		),
	),
    'view_manager' => array(
//        'template_map' => array(
//            'layout/Auth'           => __DIR__ . '/../view/layout/Auth.phtml',
//        ),
        'template_path_stack' => array(
            'user_management' => __DIR__ . '/../view'
        ),
    ),	
);