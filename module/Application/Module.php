<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Model\AdvertisementClick;
use Application\Model\AdvertiserTable;
use Application\Model\AdvertisementTypeTable;
use Application\Model\Affiliate;
use Application\Model\AdvertisementTable;
use Application\Model\Advertiser;
use Application\Model\Advertisement;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\ControllerManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    			'Application\Model\AdvertiserTable' => function($sm){
    				$tableGateway = $sm->get('AdvertiserTableGateway');
    				$table = new AdvertiserTable($tableGateway);
    				return $table;  				
    			},
    			'AdvertiserTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new Advertiser());
    				return new TableGateway('advertisers', $adapter, null, $prototype);    				
    			},
    			'Application\Model\AdvertisementTable' => function($sm){
    				$tableGateway = $sm->get('AdvertisementTableGateway');
    				$table = new AdvertisementTable($tableGateway);
    				return $table;    				
    			},
    			'AdvertisementTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new Advertisement());
    				return new TableGateway('advertisements', $adapter, null, $prototype);
    			},    			
    			'Application\Model\AffiliateTable' => function($sm){
    				$tg = $sm->get('AffiliateTableGateway');
    				$table = new \Application\Model\AffiliateTable($tg);
    				return $table;    				
    			},
    			'AffiliateTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new Affiliate());
    				return new TableGateway('affiliates', $adapter, null, $prototype);    				
    			},
    			'Application\Model\AdvertisementTypeTable' => function($sm){    				
    				$tg = $sm->get('AdvertisementTypeTableGateway');
    				$table = new AdvertisementTypeTable($tg);    				
    				return $table;    				
    			},
    			'AdvertisementTypeTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new \Application\Model\AdvertisementType());
    				return new TableGateway('advertisement_types', $adapter, null, $prototype);    				
    			},
    			'Application\Model\AdvertisementClickTable' => function($sm){
    				$tg = $sm->get('AdvertisementClickTableGateway');
    				$table = new \Application\Model\AdvertisementClickTable($tg);
    				return $table;
    			},
    			'AdvertisementClickTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new AdvertisementClick());
    				return new TableGateway('advertisement_clicks', $adapter, null, $prototype);	
    			},
    			'Application\Model\AdvertisementImpressionTable' => function($sm){
    				$tg = $sm->get('AdvertisementImpressionTableGateway');
    				$table = new \Application\Model\AdvertisementImpressionTable($tg);
    				return $table;    				
    			},
    			'AdvertisementImpressionTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new \Application\Model\AdvertisementImpression());
    				return new TableGateway('advertisement_impressions', $adapter, null, $prototype);    				
    			},
    			'Application\Model\AdvertisementCategoryTable' => function($sm){
    				$tg = $sm->get('AdvertisementCategoryTableGateway');
    				$table = new \Application\Model\AdvertisementCategoryTable($tg);
    				return $table;    
    			},
    			'AdvertisementCategoryTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new \Application\Model\AdvertisementCategory());
    				return new TableGateway('advertisement_categories', $adapter, null, $prototype);
    			},
    			'Application\Model\AdvertisementCategoryEntryTable' => function($sm){
    				$tg = $sm->get('AdvertisementCategoryEntryTableGateway');
    				$table = new \Application\Model\AdvertisementCategoryEntryTable($tg);
    				return $table;
    			},
    			'AdvertisementCategoryEntryTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new \Application\Model\AdvertisementCategoryEntry());
    				return new TableGateway("advertisement_category_entries", $adapter, null, $prototype);
    			},
    			'Application\Model\AdvertisementPlacementTypeTable' => function($sm){
    				$tg = $sm->get('AdvertisementPlacementTypeTableGateway');
    				$table = new \Application\Model\AdvertisementPlacementTypeTable($tg);
    				return $table;    				
    			},
    			'AdvertisementPlacementTypeTableGateway' => function($sm){
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$prototype = new ResultSet();
    				$prototype->setArrayObjectPrototype(new \Application\Model\AdvertisementPlacementType());
    				return new TableGateway('advertisement_placement_types', $adapter, null, $prototype);
    			}
    		)	
    	);
    }
    
    public function getControllerConfig()
    {
    	return array(
    		'factories' => array(
    			'Application\Controller\Advertiser' => function(ControllerManager $cm){
    				$sm = $cm->getServiceLocator();
    				$table = $sm->get('Application\Model\AdvertiserTable');
    				$advertisementTable = $sm->get('Application\Model\AdvertisementTable');
    				$advertisementClickTable = $sm->get('Application\Model\AdvertisementClickTable');
    				$advertisementImpressionTable = $sm->get('Application\Model\AdvertisementImpressionTable');
    				$facebook = $sm->get('Facebook');
    				$controller = new \Application\Controller\AdvertiserController($table, $advertisementTable, 
    						$advertisementClickTable, $advertisementImpressionTable, $facebook);
    				
    				return $controller;
    			},
    			'Application\Controller\Affiliate' => function(ControllerManager $cm){
    				$sm = $cm->getServiceLocator();
    				$table = $sm->get('Application\Model\AffiliateTable');
    				$facebook = $sm->get('Facebook');
    				$controller = new \Application\Controller\AffiliateController($table, $facebook);
    				
    				return $controller;
    			},
    			'Application\Controller\Index' => function(ControllerManager $cm){
    				$sm = $cm->getServiceLocator();    				
    				$facebook = $sm->get('Facebook');
    				$controller = new \Application\Controller\IndexController($facebook);
    				
    				return $controller;
    			},
    			'Application\Controller\Advertisement' => function(ControllerManager $cm){    				
    				$sm = $cm->getServiceLocator();
    				$facebook = $sm->get('Facebook');
    				$advertisementTable = $sm->get('Application\Model\AdvertisementTable');
    				$advertiserTable = $sm->get('Application\Model\AdvertiserTable');
    				$advertisementClickTable = $sm->get('Application\Model\AdvertisementClickTable');
    				$advertisementTypeTable = $sm->get('Application\Model\AdvertisementTypeTable');
    				$advertisementCategoryTable = $sm->get('Application\Model\AdvertisementCategoryTable');  
    				$advertisementCategoryEntryTable = $sm->get('Application\Model\AdvertisementCategoryEntryTable'); 
    				$advertisementPlacementTypeTable = $sm->get('Application\Model\AdvertisementPlacementTypeTable');   				
    				$controller = new \Application\Controller\AdvertisementController($advertisementTable, $advertiserTable, 
    						$advertisementClickTable, $advertisementTypeTable, 
    						$advertisementCategoryTable, $advertisementCategoryEntryTable, 
    						$advertisementPlacementTypeTable, $facebook);
    				
    				return $controller;
    			}
    		)	
    	);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        	'Zend\Loader\ClassMapAutoloader' => array(
        		__DIR__ . '/autoload_classmap.php'
        	)
        );
    }
}
