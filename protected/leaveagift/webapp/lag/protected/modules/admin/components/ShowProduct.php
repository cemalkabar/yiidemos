<?php

/* Product widget is used to display the product*/

class ShowProduct extends CWidget
{
  public $pid;
  
  public $model;

  public $show_info=false;
 
  public $logo="";
 
 public function init()
 {
  if(!isset($this->model))
   {
    $this->model=Product::model()->findbyPk($this->pid);
 
   }      
      
   $this->logo=$this->model->getSupplierLogo();
	      

	
						
 }

 public function run()
 {
     

  $this->render("product",array("model"=>$this->model));
 }  
 

}

?>
