<?php
return array(
                'name'=>'LeaveAGift',
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'preload'=>array('log'),
		'defaultController' => 'auth',
		// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.modules.admin.models.*',
		'application.components.*',
		'application.controllers.*',
		'application.helpers.*',
		//'application.extensions.crontab.*',
		//'application.extensions.encrypter.Encrypter',
	        ),

               
		'components'=>array(
		
		            'session' => array(
                                               'timeout' => 60*60*24*60,/* 60 days*/
                                              ),
       		             'cache'=>array(
				    'class'=>'CApcCache',
				  ),
	     	            'urlManager'=>array(
            	                                 'urlFormat'=>'path',
            	                                // 'showScriptName'=>false,
                                              ),
		            'encrypter'=>array (
			                      'class'=>'ext.encrypter.Encrypter',
			                      'key'=>'leaveagift',
		                              ),
                            'log'=>array(
             	                           'class'=>'CLogRouter',
             	                           'routes'=>array(
                                                	array(
                                                              'class'=>'CWebLogRoute',
                                                              'categories'=>'application',
		                       			      'levels'=>'error',
                	                                     ),
                	                                array(
                                                              'class'=>'CFileLogRoute',
                	                                     ),
              	                                          ),
                                        ),
                             'user'=>array(
        		                    'loginUrl'=>array('auth/login'),
               		                    'allowAutoLogin'=>true,
    		                          ),
    		             'request'=>array(
                                            'class'=>'application.components.HttpRequest',
            	                            'enableCsrfValidation'=>false,
                                            'noCsrfValidationRoutes'=>array('paygift/return'),

			                    ),
			     'db'=>array(
				           'connectionString' => 'mysql:host=localhost;dbname=leaveagift',
				           'emulatePrepare' => true,
				           'username' => 'root',
                                          'password' => '123',
	                		  // 'password' => 'lgd*#29LQ',
				           'charset' => 'utf8',
					   'enableProfiling'=>true, 


			               ),
				/* 'errorHandler'=>array(
           				 'errorAction'=>'auth/lagError',),*/
				 
				'image'=>array(
						  'class'=>'application.extensions.image.CImageComponent',
						    // GD or ImageMagick
						    'driver'=>'GD',
						    // ImageMagick setup path
						    'params'=>array('directory'=>'/opt/local/bin'),
						),
					/*
					'iwi' => array(
					    'class' => 'application.extensions.iwi.IwiComponent',
					    // GD or ImageMagick
					    'driver' => 'imagemagick',
					    // ImageMagick setup path
					    'params'=>array('directory'=>'/etc/imagemagick'),
					),
					*/
				'simpleImage'=>array(
                        		'class' => 'application.extensions.CSimpleImage',
                					),
				'file'=>array(
        				'class'=>'application.extensions.file.CFile',
    				),
				's3'=>array(
					'class'=>'ext.S3.ES3',
					'aKey'=>'AKIAJJSO2S6NQLNICLNA', 
					'sKey'=>'EQceUMphzbzPYSG0dT8MEZmVIkmobW45YH3WsWIk',
    				),
				'googleAnalytics' => array(
					    'class' =>'ext.TPgoogleAnalytics.components.TPGoogleAnalytics',
					    'account' => 'UA-34867272-1',
    					    'autoRender' => true,
					),

				/* comment it when uploading on main server--start of log component-- */

				'log'=>array(
					    'class'=>'CLogRouter',
					    'routes'=>array(
							    array(
								'class'=>'CProfileLogRoute',
								'levels'=>'error, warning, trace, info, profile',
							    ),
							    array(
								'class'=>'CWebLogRoute',
								'levels'=>'error, warning, trace, info, profile',
								'showInFireBug'=>false,
							    ),
						),
					),
			/* end of log component-- */			

			/*
				'commandMap' => array(
					    'cron' => 'ext.PHPDocCrontab.PHPDocCrontab'
					),

			*/	

                      ),/*end components*/
		 
		 'modules'=>array(
		// uncomment the following to enable the Gii tool
		        'admin',
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'leaveagift',
                                   'generatorPaths' => array(
                                                   'application.modules.admin.extensions.giiplus', 
                                                 ),
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters'=>array('127.0.0.1','::1'),
		 ),
               
		

		
        	),
           'params' => array(
// this is used in contact page
	
                /* Dev. app*/

                 'facebook_appId' => '421281037909823',
		  'facebook_appSecret' => '0d5f0dbfe5f727899dac4d771d203367',



                /* Test app. */
             /*   'facebook_appId' => '476177222402177',
		 'facebook_appSecret' => 'b90d84496b34b9a1eab6b84db9f5c185',*/
		'facebook_scope' => 'email,read_friendlists,publish_stream,user_birthday,friends_birthday,friends_location,user_location,friends_photos,user_photos',
		'facebook_appname' => 'yourappname',
		'post_facebook_appId' => '421281037909823',
		'post_facebook_appSecret' => '0d5f0dbfe5f727899dac4d771d203367',

		//for sendgrid
		'sendgridurl' =>'http://sendgrid.com/',
		'usersendgrid' => 'jaideep@leaveagift.com',
		'passsendgrid' => 'lovegifts',
		
		//for email settings
		'adminEmail' => 'donotreply@leaveagift.com',
		'adminName' => 'LeaveAGift Team',
		'hostname' => 'http://www.leaveagift.com/',
		
		//for citrus 
		'mkey' => 'VK00TSSYM1NXNVR3ONRC',
		'skey' => '5a45567fecb08a3361398947c7d3d825bc2fa426',
		'env' =>'sandbox',

		//amazon s3 settings
		'iurl'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/',
		'udurl'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/uploaded/',
		'surl'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/suppliers/',
		'purl'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/products/',
		'furl'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/frontend/',
       
                'producttemplatepics'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/producttemplatepics/',
 
                'productpics'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/productpics/',
     
                'supplierpics'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/supplierpics/',

                'brandpics'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/brandpics/',
                
                'uploaded'=>'https://s3-ap-southeast-1.amazonaws.com/lagdev/uploaded/',

                //product Image resize dimensions when excel importing
                'producttemplateResizeDimensions'=>array(
                                                 array('199','138'), /*positiion1*/
                                                 array('280','199'), /*positiion2*/ 
                                                ),
                'productResizeDimensions'=>array(
                                                 array('199','138'), /*positiion1*/
                                                 array('280','199'), /*positiion2*/ 
                                                ),
                'supplierResizeDimensions'=>array(
                                                 array('100','22'), /*positiion1*/
                                                 array('225','59'), /*positiion2*/ 
                                                ),
                'brandResizeDimensions'=>array(
                                                 array('100','22'), /*positiion1*/
                                                 array('225','59'), /*positiion2*/ 
                                                ),
		
		'maxNoFreeGift'=>'3', /*  max number of free gifts one user can recieve*/
		
		'myurl' => 'https://www.leaveagift.com/auth/login',
			
	),
	
         

        );
