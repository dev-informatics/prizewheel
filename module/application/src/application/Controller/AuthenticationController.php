<?php

namespace Application\Controller;

use Application\Form\ManageUserForm;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;

class AuthenticationController extends AbstractActionController
{
	protected $authenticationService = null;
	protected $userDataSourceInterface = null;
	protected $dbAdapter = null;
	protected $blockCipher = null;
	
	/**
	 * 
	 * @param \Application\Model\PrizeWheelAuthenticationAdapter $adapter
	 */
	public function __construct(\Application\Model\PrizeWheelAuthenticationAdapter $adapter, 
			\Application\Model\UserDataSourceInterface $userDataSourceInterface, $blockCipher=null)
	{
		// @todo I really need to convert the AuthAdapter to an interface that can be programmed against,
		// \Zend\Authentication\Adapter\AdapterInterface is not sufficient for a proper Liskov Substitution.
		$this->dbAdapter = $adapter;
		$this->userDataSourceInterface = $userDataSourceInterface;
		$this->authenticationService = new AuthenticationService();	
		$this->blockCipher = $blockCipher;
	} // ctor
	
	public function loginAction()
	{
		$form = new \Application\Form\LoginForm();
		$request = $this->getRequest();
				
		$authenticationMessages = array();
		
		if($request->isPost()){
			$form->setData($request->getPost());
			
			if($form->isValid()){				
				
				$data = $form->getData();
				
				$this->dbAdapter->userName($data['username']);
				$this->dbAdapter->password($data['password']);
				$response = $this->authenticationService->authenticate($this->dbAdapter);
				
				if($response->isValid()){
					if(isset($data['redirecturl'])){
						return $this->redirect()->toUrl($data['redirecturl']);
					} // if
					else{
						return $this->redirect()->toRoute('admin');
					} // else
				} // if
				else{
					$authenticationMessages = $response->getMessages();
				} // else
			} // if
		} // if
		
		$redirectUrl = $this->params()->fromQuery('redirecturl', "");
		
		return new ViewModel(array(
			'form' => $form,
			'redirecturl' => $redirectUrl,
			'authenticationmessages' => $authenticationMessages	
		));
	}
	
	public function logoutAction()
	{
		$this->authenticationService->clearIdentity();
		
		return $this->redirect()->toRoute('authentication');
	}
	
	public function manageAction()
	{
		$request = $this->getRequest();
		$form = new ManageUserForm();
		$form->setAttribute('action', $this->url()->fromRoute('authentication', array('action' => 'manage', 'id' => $this->userDataSourceInterface->getUserByUserName('admin')->id())));
		
		if($request->isPost()){
			$form->setData($request->getPost());
			
			if($form->isValid()){
				
				$userId = (int)$this->params()->fromRoute('id', 0);
				
				$password = $form->get('password')->getValue();
				$cipherPassword = $this->blockCipher->encrypt($password);
				$this->userDataSourceInterface->updatePassword($userId, $cipherPassword);
			} // if
		} // if
		
		return new ViewModel(array(
					'form' => $form
				));
	}
}