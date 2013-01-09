<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
        	'advertisement-category' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/advertisement-category[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\AdvertisementCategory',
        				'action' => 'list'
        			)
        		)
        	),
        	'affiliate-payout-entry' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/affiliate-payout-entry[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\AffiliatePayoutEntry',
        				'action' => 'list'
        			)
        		)
        	),
        	'transaction' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/transaction[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\Transaction',
        				'action' => 'list'
        			)
        		)
        	),
        	'prize-wheel' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/prize-wheel[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\PrizeWheel',
        				'action' => 'index'
        			)
        		)	
        	),
        	'authentication' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/authentication[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\Authentication',
        				'action' => 'login'		
        			)
        		)
        	),
        	'affiliate' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/affiliate[/:action][/:id]',
        			'constraints' => array(        				
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\Affiliate',
        				'action' => 'index'
        			)
        		)
        	),
        	'prize-wheel-entry' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/prize-wheel-entry[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\PrizeWheelEntry'
        			)
        		)
        	),
        	'advertiser' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/advertiser[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\Advertiser',
        				'action' => 'index'
        			)
        		)
        	),
        	'admin' => array(
        		'type' => 'literal',
        		'options' => array(
        			'route' => '/admin',
        			'defaults' => array(
        				'controller' => 'Application\Controller\Admin',
        				'action' => 'index'
        			)
        		)
        	),
        	'revenue-and-payouts-report' => array(
        		'type' => 'literal',
        		'options' => array(
        			'route' => '/admin/revenue-and-payouts-report',
        			'defaults' => array(
        				'controller' => 'Application\Controller\Admin',
        				'action' => 'revenue-and-payouts-report'
        			)
        		)
        	),
        	'instant-payment-notification' => array(
        		'type' => 'literal',
        		'options' => array(
        			'route' => '/instant-payment-notification',
        			'defaults' => array(
        				'controller' => 'Application\Controller\Admin',
        				'action' => 'instant-payment-notification'
        			)
        		)
        	),
        	'settings' => array(
        		'type' => 'literal',
        		'options' => array(
        			'route' => '/admin/settings',
        			'defaults' => array(
        				'controller' => 'Application\Controller\Admin',
        				'action' => 'settings'
        			)
        		)
        	),
        	'click' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/advertisement/click[/:id][/:prizewheelid]',
        			'constraints' => array(
        				'id' => '[0-9]+',
        				'prizewheelid' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\Advertisement'
        			)
        		)
        	),
        	'advertisement' => array(
        		'type' => 'segment',
        		'options' => array(
        			'route' => '/advertisement[/:action][/:id]',
        			'constraints' => array(
        				'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        				'id' => '[0-9]+'
        			),
        			'defaults' => array(
        				'controller' => 'Application\Controller\Advertisement',
        				'action' => 'index'
        			)
        		)
        	),
        	'ads' => array(
	        	'type' => 'segment',
	        	'options' => array(
	        		'route' => '/ads[/:action][/:id][/:prizewheelid]',
	        		'constraints' => array(
	        			'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
	        			'id' => '[0-9]+',
	        			'prizewheelid' => '[0-9]+'
	        		),
	        		'defaults' => array(
	        			'controller' => 'Application\Controller\Advertisement',
	        			'action' => 'click'
	        		)
	        	)
        	),
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'about' => array(
            	'type' => 'Zend\Mvc\Router\Http\Literal',
            	'options' => array(
            		'route' => '/about',
            		'defaults' => array(
            			'controller' => 'Application\Controller\Index',
            			'action' => 'about'
            		)
            	)
            ),
            'terms' => array(
            	'type' => 'Zend\Mvc\Router\Http\Literal',
            	'options' => array(
            		'route' => '/terms',
            		'defaults' => array(
            			'controller' => 'Application\Controller\Index',
            			'action' => 'terms'
            		)
            	)
            ),
            'demo' => array(
            	'type' => 'Zend\Mvc\Router\Http\Literal',
            	'options' => array(
            		'route' => '/demo',
            		'defaults' => array(
            			'controller' => 'Application\Controller\Index',
            			'action' => 'demo'
            		)
            	)
            ),
            'contact' => array(
            	'type' => 'Zend\Mvc\Router\Http\Literal',
            	'options' => array(
            		'route' => '/contact',
            		'defaults' => array(
            			'controller' => 'Application\Controller\Index',
            			'action' => 'contact'
            		)
            	)
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/admin_layout'     => __DIR__ . '/../view/layout/admin_layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'prize-wheel/index'       => __DIR__ . '/../view/application/prize-wheel/index.phtml',
            'application/partial/registration' => __DIR__ . '/../view/partial/registration.phtml',
            'prize-wheel/non-fan' 	  => __DIR__ . '/../view/application/prize-wheel/non-fan.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
        	'ViewJsonStrategy'
        )
    ),
);
