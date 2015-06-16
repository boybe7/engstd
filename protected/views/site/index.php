<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$theme = Yii::app()->theme;
$cs = Yii::app()->clientScript;
$cs->registerScriptFile( $theme->getBaseUrl() . '/js/highcharts.js' );
//$cs->registerCssFile($theme->getBaseUrl() . '/css/ProgressTracker.css');

?>



<div id="modal-content" class="hide">
    <div id="modal-body">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	
      

    	?>
    </div>
</div>


