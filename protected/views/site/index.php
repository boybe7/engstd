<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$theme = Yii::app()->theme;
$cs = Yii::app()->clientScript;
$cs->registerScriptFile( $theme->getBaseUrl() . '/js/highcharts.js' );
//$cs->registerCssFile($theme->getBaseUrl() . '/css/ProgressTracker.css');

?>
<div class="hero-unit">
  <h2>ยินดีต้อนรับเข้าสู่</h2>
  <h1>ระบบใบรับรองมาตรฐานครุภัณฑ์</h1>
  <p>ส่วนควบคุมการผลิตท่อและอุปกรณ์ กองมาตรฐานวิศวกรรม</p>
  <p>
    <a class="btn btn-primary btn-large">
      คู่มือการใช้งาน
    </a>
  </p>
</div>


<div id="modal-content" class="hide">
    <div id="modal-body">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	
   

    	?>
    </div>
</div>


