<?php


class ReportController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public $layout='//layouts/column2';
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
       

	/**
	 * Displays the progress page
	 */
	public function actionVendor()
	{
		$this->render('vendor');
	}

	public function actionGenVendor()
	{
		
		$vid = $_GET["vendor"];
		$modelV = Vendor::model()->findByPk($vid);

		$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));	

		$this->renderPartial('_formVendor', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);
	}


}

?>