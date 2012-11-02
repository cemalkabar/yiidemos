<?php

class SupplierController extends CController
{
        public $breadcrumbs;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
                        'users',
		);
	}
        public function filterUsers($filter)
         {
           $session=new CHttpSession;
           $session->open();
          
            if(Yii::app()->user->isGuest)
		{
                        $this->redirect(Yii::app()->createAbsoluteUrl("auth/index"));
		}
                 $criteria=new CDbCriteria;
                 $criteria->condition="facebook_userid=:facebook_userid";
                 $criteria->params=array(':facebook_userid'=>$session['me']['id']);
                 $user=User::model()->find($criteria);
                 if($user==null)
                  {
                    $this->redirect(Yii::app()->createAbsoluteUrl("auth/index"));
               
                  }
                 if($user->is_admin==0)
                  {
                     $this->redirect(Yii::app()->createAbsoluteUrl("auth/index"));
                  }

              $filter->run();
         }

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GeneratePdf','GenerateExcel'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
          Yii::import('application.extensions.image.Image');
          Yii::import("application.extensions.S3.*");
		$model=new Supplier;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Supplier']))
		{
			$model->attributes=$_POST['Supplier'];
                        $uploadedFile=CUploadedFile::getInstance($model,'logo'); 
                        $uploadedFile2=CUploadedFile::getInstance($model,'logo2');

                        $model->date_upd=date('Y-m-d H:i:s',time());
                        $model->date_add=date('Y-m-d H:i:s',time());
			if($model->save())
                          {
                            $model->save(false);

                            if(isset($uploadedFile))
                                   {
                               
                                       $model->saveImageToS3($uploadedFile,0);
                                   }
                            if(isset($uploadedFile2))
                                   {
                               
                                       $model->saveImageToS3($uploadedFile2,1);
                                   }

                           /* if(isset($uploadedFile))
                                   {
                                      
                                        $dir_path=Yii::app()->basePath.'/assets/images/'; 
                                
                         
		                         foreach(Yii::app()->params['supplierResizeDimensions'] as $key=>$d)
		                          {
		                            //echo "<br/>coool";
		                          $image = new Image($uploadedFile->getTempName());
		                          $image->resize($d[0], $d[1])->rotate(0)->quality(100)->sharpen(0);
                                          $fileName=$uploadedFile->getName().$model->id_supplier.$d[0].$d[1].".png";

		                          $resizedImagePath=$dir_path.$fileName; 

		                          $image->save($resizedImagePath);
                                  

		                           $success = Yii::app()->s3->upload( $resizedImagePath , 'supplierpics/'.$fileName, 'lagdev' );

                                           $simage=new SupplierImages;
                                           $simage->id_supplier=$model->id_supplier;
                                           $simage->position=$key;
					   $simage->filename = $fileName;  // random number + file name
					   $simage->save(false);

		                            unlink($resizedImagePath);
		                          
		                          }



                                   
                                   }*/
				$this->redirect(array('view','id'=>$model->id_supplier));
                          }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
          Yii::import('application.extensions.image.Image');
          Yii::import("application.extensions.S3.*");
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Supplier']))
		{
			$model->attributes=$_POST['Supplier'];
                        $uploadedFile=CUploadedFile::getInstance($model,'logo');
                        $uploadedFile2=CUploadedFile::getInstance($model,'logo2');
 
                        $model->date_upd=date('Y-m-d H:i:s',time());
			if($model->save())
                          {
                             $model->save(false);

                              if(isset($uploadedFile))
                                   {
                                       $model->removeSupplierImage(0);
                                       $model->saveImageToS3($uploadedFile,0);
                                   }
                              if(isset($uploadedFile2))
                                   {
                                       $model->removeSupplierImage(1);
                                       $model->saveImageToS3($uploadedFile2,1);
                                   }
                               /*

                               if(isset($uploadedFile))
                                   {
                                     if(!empty($model->logo))
                                      {
                                         if(file_exists(Yii::app()->basePath.'/assets/images/suppliers/'.$model->logo))
                                          unlink(Yii::app()->basePath.'/assets/images/suppliers/'.$model->logo);
                                      }
                                      
                                      

                                        $dir_path=Yii::app()->basePath.'/assets/images/'; 
                                
                                         if(count(Yii::app()->params['supplierResizeDimensions'])>0)                    
                                         $model->removepreveousImages();
 
		                         foreach(Yii::app()->params['supplierResizeDimensions'] as $key=>$d)
		                          {
		                            //echo "<br/>coool";
		                          $image = new Image($uploadedFile->getTempName());
		                          $image->resize($d[0], $d[1])->rotate(0)->quality(100)->sharpen(0);
                                          $fileName=$uploadedFile->getName().$model->id_supplier.$d[0].$d[1].".png";

		                          $resizedImagePath=$dir_path.$fileName; 

		                          $image->save($resizedImagePath);
                                  

		                           $success = Yii::app()->s3->upload( $resizedImagePath , 'supplierpics/'.$fileName, 'lagdev' );
                                    
                                            
                                            $simage=new SupplierImages;
                                            $simage->id_supplier=$model->id_supplier;
                                            $simage->position=$key;
					    $simage->filename = $fileName;  // random number + file name
					    $simage->save(false);

		                            unlink($resizedImagePath);
		                          
		                          }

                                   
                                   }
                                  */
				$this->redirect(array('view','id'=>$model->id_supplier));
                          }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			 $model=$this->loadModel($id);
  
                      if(!$model->isUsed())
                        {
                         $model->removepreveousImages();
			 $model->delete();
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	 // Yii::import('application.extensions.image.Image');
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new Supplier('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Supplier']))
		{
                        $model->attributes=$_GET['Supplier'];
			
			
                   	
                       if (!empty($model->id_supplier)) $criteria->addCondition('id_supplier = "'.$model->id_supplier.'"');
                     
                    	
                       if (!empty($model->name)) $criteria->addCondition('name = "'.$model->name.'"');
                     
                    	
                       if (!empty($model->date_add)) $criteria->addCondition('date_add = "'.$model->date_add.'"');
                     
                    	
                       if (!empty($model->date_upd)) $criteria->addCondition('date_upd = "'.$model->date_upd.'"');
                     
                    	
                       if (!empty($model->active)) $criteria->addCondition('active = "'.$model->active.'"');
                     
                    	
                       if (!empty($model->logo)) $criteria->addCondition('logo = "'.$model->logo.'"');
                     
                    			
		}
                 $session['Supplier_records']=Supplier::model()->findAll($criteria); 
       

                $this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Supplier('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Supplier']))
			$model->attributes=$_GET['Supplier'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Supplier::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='supplier-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Supplier_records']))
               {
                $model=$session['Supplier_records'];
               }
               else
                 $model = Supplier::model()->findAll();

		
		Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('excelReport', array(
				'model'=>$model
			), true)
		);
	}
        public function actionGeneratePdf() 
	{
           $session=new CHttpSession;
           $session->open();
		Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
		require_once('tcpdf/tcpdf.php');
		require_once('tcpdf/config/lang/eng.php');

             if(isset($session['Supplier_records']))
               {
                $model=$session['Supplier_records'];
               }
               else
                 $model = Supplier::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Supplier Report');
		$pdf->SetSubject('Supplier Report');
		//$pdf->SetKeywords('example, text, report');
		$pdf->SetHeaderData('', 0, "Report", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Example Report by ".Yii::app()->name, "");
		$pdf->setHeaderFont(Array('helvetica', '', 8));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 18, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('dejavusans', '', 7);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("Supplier_002.pdf", "I");
	}
}
