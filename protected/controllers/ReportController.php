<?php


class ReportController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	//public $layout='//layouts/column2';

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
        public function actionR1()
	{
		$this->render('r1');
	}

	public function actionGenR1()
	{

		//$vid = $_GET["r1"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR1', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        public function actionR2()
	{
		$this->render('r2');
	}

	public function actionGenR2()
	{

		//$vid = $_GET["r2"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR2', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        public function actionR3()
	{
		$this->render('r3');
	}

	public function actionGenR3()
	{

		$vid = $_GET["r3"];
		$modelV = Vendor::model()->findByPk($vid);

		$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));

		$this->renderPartial('_formR3', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);
	}


        //-----------------------------
        public function actionR4()
	{
		$this->render('r4');
	}

	public function actionGenR4()
	{
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR4', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}

	public function actionPrintR4()
        {
        	
	    
	          $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR4_PDF', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);

        
        }


        //-----------------------------
        public function actionR5()
	{
		$this->render('r5');
	}

	public function actionGenR5()
	{
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR5', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        public function actionR6()
	{
		$this->render('r6');
	}

	public function actionGenR6()
	{
		//$vid = $_GET["r9"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR6', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        public function actionR7()
	{
		$this->render('r7');
	}

	public function actionGenR7()
	{


		//$vid = $_GET["r9"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR7', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        public function actionR8()
	{
		$this->render('r8');
	}

	public function actionGenR8()
	{

		//$vid = $_GET["r9"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR8', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        
        public function actionR9()
	{
		$this->render('r9');
	}

	public function actionGenR9()
	{

		//$vid = $_GET["r9"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR9', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}

        //-----------------------------
        public function actionR10()
	{
		$this->render('r10');
	}

	public function actionGenR10()
	{

		
                $month = $_GET["monthEnd"];
                $year = $_GET["yearEnd"];

		
		$this->renderPartial('_formR10', array(
           
            'month'=>$month,
            'year'=>$year,

            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        public function actionR11()
	{
		$this->render('r11');
	}

	public function actionGenR11()
	{


                $month = $_GET["monthEnd"];
                $year = $_GET["yearEnd"];


		$this->renderPartial('_formR11', array(

            'month'=>$month,
            'year'=>$year,

            'display' => 'block',
        ), false, true);
	}
        //-----------------------------



        //////////////////////////////
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