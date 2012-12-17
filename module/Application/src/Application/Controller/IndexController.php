<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Model\Advertiser;

class IndexController extends FacebookAwareController
{
	public function __construct(\Facebook $facebook)
	{
		$this->facebook = $facebook;
	}
	
    public function indexAction()
    {    	
    	$advertiser = new Advertiser;
    	
    	$advertiser->firstName("Michael");
    	
        return new ViewModel(array(
        	'advertiser' => $advertiser,
        	'facebook' => $this->getUserInformation()
        ));
    }
    
    public function aboutAction()
    {
    	return new ViewModel();
    }
    
    public function termsAction()
    {
    	return new ViewModel();
    }
    
    public function contactAction()
    {
    	return new ViewModel();
    }
}
