<?php

/**
 * UseGiftForm class.
 * UseGiftForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class UseGiftForm extends CFormModel
{
	
	public $verifyCode;
	
	public $is_verified;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			//array('is_verified','safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Please verify you\'re a real person - Enter the code below:',
		);
	}
}
