<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Entity\Transactions;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class IndexController extends AbstractActionController implements ServiceLocatorAwareInterface
{
    protected $_objectManager;
    protected $sm;
    
    public function indexAction()
    {
    	$transactions = $this->getObjectManager()->getRepository('\Application\Entity\Transactions')->findAll();
        
        return new ViewModel(array(
        		'transactions' => $transactions
        ));
    }
    
    public function consumeAction()
    {
    	$jsonPost = $this->getRequest()->getContent();
    	$post = json_decode($jsonPost);
    	
    	$contentType = $this->getRequest()->getHeaders()->get('content-type');
    	if (is_object($contentType) && $contentType->value == "application/json") {
    		if (!empty($post)) {
    			$item = new Transactions();
		    	$item->setString(serialize($post));
		    	$this->getObjectManager()->persist($item);
		    	$this->getObjectManager()->flush();
		    	$status = "stored";
    		} else {
    			$status = "No data";
    		}
    	} else {
    		$status = "Data must be in JSON format";
    	}
    	
    	$jsonView = array(
    			'status' => $status,
    			'data' => $post
    	);
    	
    	$jsonModel = new JsonModel();
    	$jsonModel->setVariables(array('jsonPost' => json_encode($jsonView)))
    	->setTerminal(true);
    	
    	return $jsonModel;
    }
    
    protected function getObjectManager()
    {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }
}