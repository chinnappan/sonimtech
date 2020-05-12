<?php

namespace UserManagement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\File\Size;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mail;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

use Zend\Mail\Transport\InMemory as InMemoryTransport;
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Db\Adapter\Adapter as DbAdapter;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;

use UserManagement\Form\UserForm;
use UserManagement\Form\UserFilter;
use UserManagement\Form\LoginForm;
use UserManagement\Form\ExchangeForm;

class UserController extends AbstractActionController
{
	private $usersTable;
	private $exchangeTable;
	
	public function indexAction()
	{
		return new ViewModel();
	}
	
	//Registration form
	public function createAction()
	{
		$form = new UserForm();
		$request = $this->getRequest();
        if ($request->isPost()) {
			$form->setInputFilter(new UserFilter());
			$form->setData($request->getPost());
			 if ($form->isValid()) {
				$data = $form->getData();
				$File    = $this->params()->fromFiles('user_picture');
				/// File upload //
				$size = new Size(array('min'=>100)); //minimum bytes filesize
     
				$adapter = new \Zend\File\Transfer\Adapter\Http(); 
				//validator can be more than one...
				$adapter->setValidators(array($size), $File['name']);
				
				if (!$adapter->isValid()){
					echo 'sasa';
					$dataError = $adapter->getMessages();
					$error = array();
					foreach($dataError as $key=>$row)
					{
						$error[] = $row;
					} //set formElementErrors
					$form->setMessages(array('fileupload'=>$error ));
				} else {
					
					$destination = './public/img';
					$ext = pathinfo($File['name'], PATHINFO_EXTENSION);
					$newName = md5(rand(). $file['name']) . '.' . $ext;
					$adapter->addFilter('File\Rename', array(
						'target' => $destination . '/' . $newName,
					));
					if ($adapter->receive($File['name'])) {
						$file = $adapter->getFilter('File\Rename')->getFile();
						$target = $file[0]['target'];
						//var_dump($target);
					}
				}  
				/// File upload //
				$rawPassword = rand(). $data['user_email'];
				
				// Send mail
				$message = new Message();
				$message->addTo($data['user_email'])
				->addFrom('chinnappan2008@gmail.com')
				->setSubject('Greetings and Salutations! Password word details')
				->setBody("Thanks for registering . Login details username : ".$data['user_email']."  password :".$rawPassword);

				// Setup InMemory transport
				$transport = new InMemoryTransport();
				$transport->send($message);

				// Verify the message:
				$received = $transport->getLastMessage();
				// Send mail
				
				$data['user_password'] = md5($rawPassword);
				$data['user_picture'] = $newName;
				unset($data['submit']);						
				$this->getUsersTable()->insert($data);
				return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'thankyou'));										
			}
		}		
		return new ViewModel(array('form' => $form));
	}
	
	// Update profile
	public function updateAction()
	{
		$auth = new AuthenticationService();
		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
		}else{
			return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'login'));
		}	 
		$id = $identity->user_id;
		if (!$id) return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'index'));
		$form = new UserForm();
		$request = $this->getRequest();
        if ($request->isPost()) {
			$form->setInputFilter(new UserFilter());
			$form->setData($request->getPost());
			 if ($form->isValid()) {
				$data = $form->getData();
				
				$File    = $this->params()->fromFiles('user_picture');
				/// File upload //
				$size = new Size(array('min'=>100)); //minimum bytes filesize
     
				$adapter = new \Zend\File\Transfer\Adapter\Http(); 
				//validator can be more than one...
				$adapter->setValidators(array($size), $File['name']);
				
				if (!$adapter->isValid()){
					echo 'sasa';
					$dataError = $adapter->getMessages();
					$error = array();
					foreach($dataError as $key=>$row)
					{
						$error[] = $row;
					} //set formElementErrors
					$form->setMessages(array('fileupload'=>$error ));
				} else {
				    $destination = './public/img';
					//echo $destination = dirname(__DIR__).'/assets';
					//die;
					$ext = pathinfo($File['name'], PATHINFO_EXTENSION);
					$newName = md5(rand(). $file['name']) . '.' . $ext;
					$adapter->addFilter('File\Rename', array(
						'target' => $destination . '/' . $newName,
					));
					if ($adapter->receive($File['name'])) {
						$file = $adapter->getFilter('File\Rename')->getFile();
						$target = $file[0]['target'];
						//var_dump($target);
					}
				}  
				/// File upload //
				$data['user_picture'] = $newName;
				unset($data['submit']);
				$this->getUsersTable()->update($data, array('user_id' => $id));
				return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'view'));													
			}			 
		}
		else {
			$userdeatils = $this->getUsersTable()->select(array('user_id' => $id))->current();
			$form->setData($userdeatils);			
		}
		return new ViewModel(array('form' => $form, 'userdeatils' => $userdeatils));		
	}
	
	// Logout User
	public function logoutAction()
	{
		$auth = new AuthenticationService();
		$auth->clearIdentity();
		return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'index'));		
		//break;
	}
	
	public function loginAction()
	{
		$form = new LoginForm();
		$messages ='';
		$request = $this->getRequest();
        if ($request->isPost()) {			
			$form->setData($request->getPost());
			 if ($form->isValid()) {
				$data = $form->getData();
				unset($data['submit']);
				
				$data = $request->getPost();
				$sm = $this->getServiceLocator();
				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				
				$config = $this->getServiceLocator()->get('Config');
				$authAdapter = new AuthAdapter($dbAdapter,
										   'users', 
										   'user_email',
										   'user_password',
										   "MD5(?)" 
										  );
				$authAdapter
					->setIdentity($data['user_email'])
					->setCredential($data['user_password'])
				;
				$auth = new AuthenticationService();
				$result = $auth->authenticate($authAdapter);
				switch ($result->getCode()) {
					case Result::FAILURE_IDENTITY_NOT_FOUND:
						//echo 'FAILURE_IDENTITY_NOT_FOUND';
						//return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'login'));		
						break;

					case Result::FAILURE_CREDENTIAL_INVALID:
						//echo 'FAILURE_IDENTITY_NOT_FOUND';
						//return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'login'));		
						//echo 'dfd';
						break;

					case Result::SUCCESS:
						$storage = $auth->getStorage();
						$storage->write($authAdapter->getResultRowObject(
							null,
							'user_password'
						));
						$identity = $auth->getIdentity();
						print_r($identity);
						$form->setAttribute('action', $this->url('user_management/default', array('controller' => 'user', 'action' => 'update', 'id' => $id))); //'contact/process'));
						return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'view'));		
						break;

					default:
						// do stuff for other failure
						break;
				}				
				foreach ($result->getMessages() as $message) {
					//$messages .= "$message\n"; 
					$messages = 'Invalid username / Password';
				}
				//return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'login'));										
			}
		}
				

		return new ViewModel(array('form' => $form,'messages'=>$messages));
	}


	public function getUsersTable()
	{
		if (!$this->usersTable) {
			$this->usersTable = new TableGateway(
				'users', 
				$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
			);
		}
		return $this->usersTable;
	}

	public function getExchangeTable()
	{
		if (!$this->exchangeTable) {
			$this->exchangeTable = new TableGateway(
				'exchange', 
				$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
			);
		}
		return $this->exchangeTable;
	}

	//View Profile
	public function viewAction()
	{
		
		$auth = new AuthenticationService();

		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
			
			$userdetails= $this->getUsersTable()->select(array('user_id' => $identity->user_id))->current();
		}else{
			return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'login'));
		}

		$user_favorite	=	$userdetails['user_favorite'];
		$user_favorite_data='';
		if(!empty($user_favorite)){
			$var_favorite =explode(',',$user_favorite);
			$user_favorite_data= $this->getExchangeTable()->select(array('exchange_id ' => $var_favorite));
			
		}
		//die;

		return new ViewModel(array('userdetails' => $userdetails,'userfavoritedata'=>$user_favorite_data));	
	}

	// View Rate of Exchange
	public function rateofexchangeAction()
	{
		$auth = new AuthenticationService();
		
		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
		}else{
			return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'login'));
		}
		$request = $this->getRequest();
        if ($request->isPost()) {
			$data = $request->getPost();
			$myfavorite = array();
			foreach($data as $key=>$d){					
					if($d =='yes'){
						$explodekey = explode('my-favorite-',$key);
						$myfavorite[] = $explodekey[1];
					}
			}
			$datas['user_favorite'] =implode(',',$myfavorite);
			$this->getUsersTable()->update($datas, array('user_id' => $identity->user_id));			
		}	
		$userdeatils = $this->getUsersTable()->select(array('user_id' => $identity->user_id))->current();
		$form = new ExchangeForm();
		return new ViewModel(array('form'=>$form,'rowset' => $this->getExchangeTable()->select(),'userdeatils'=>$userdeatils));
	}


	public function viewimageAction()
	{
		

		$auth = new AuthenticationService();
		
		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
			
			$userdetails= $this->getUsersTable()->select(array('user_id' => $identity->user_id))->current();
		}else{

			return $this->redirect()->toRoute('user_management/default', array('controller' => 'user', 'action' => 'login'));
		}
		//print_r($userdetails);
		return new ViewModel(array('userdetails' => $userdetails));					
	}

	public function thankyouAction()
	{
	
		//print_r($userdetails);
		return new ViewModel();					
	}

}