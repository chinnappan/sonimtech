<?php

namespace UserManagement;
use Zend\Authentication\Adapter\DbTable as DbAuthAdapter;
use Zend\Authentication\AuthenticationService;
// for Acl
use UserManagement\Acl\Acl;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
	
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
	}
	
	public function getServiceConfig()
{
 return array(  
 'factories'=>array('Application\Model\StudentTable'=>function($sm){
                       $tableGateway=$sm->get('StudentTableGateway');
    		       $table=new StudentTable($tableGateway);
    		       return $table;
    		       },
    		   'StudentTableGateway'=>function($sm){
    		        $dbAdapter= $sm->get('Zend\Db\Adapter\Adapter');
    		        $resultSetPrototype= new ResultSet();
    		        $resultSetPrototype->setArrayObjectPrototype(new Student());
    		        return new TableGateway('student',$dbAdapter,null,$resultSetPrototype );
    		       },
 		  'AuthService' => function ($serviceManager) {
                	$adapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                    	$dbAuthAdapter = new DbAuthAdapter ( $adapter, 'users', 'usr_email', 'usr_password' );
                        $auth = new AuthenticationService();
                    	$auth->setAdapter ( $dbAuthAdapter );
                    	return $auth;
                        }

    	));
    	
    }  
}