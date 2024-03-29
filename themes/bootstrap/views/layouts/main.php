<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<script type="text/javascript" src="/engstd/themes/bootstrap/js/jquery.yiigridview.js"></script>
	<?php 
       /* Yii::app()->getClientScript()->reset(); 
        Yii::app()->bootstrap->register();   */

        
        Yii::app()->bootstrap->init();
        //$cs = Yii::app()->clientScript;
        //$cs->registerScriptFile(Yii::app()->theme->getBaseUrl().'/js/jquery.yiigridview.js');
  ?>
  
   <script type="text/javascript">
    //<![CDATA[
   /* var owa_baseUrl = 'http://172.16.184.93/webstat/';
    var owa_cmds = owa_cmds || [];
    owa_cmds.push(['setSiteId', '7b41c635c3c7c9f89fed80c2e5b066ec']);
    owa_cmds.push(['trackPageView']);
    owa_cmds.push(['trackClicks']);
    owa_cmds.push(['trackDomStream']);

    (function() {
      var _owa = document.createElement('script'); _owa.type = 'text/javascript'; _owa.async = true;
      owa_baseUrl = ('https:' == document.location.protocol ? window.owa_baseSecUrl || owa_baseUrl.replace(/http:/, 'https:') : owa_baseUrl );
      _owa.src = owa_baseUrl + 'modules/base/js/owa.tracker-combined-min.js';
      var _owa_s = document.getElementsByTagName('script')[0]; _owa_s.parentNode.insertBefore(_owa, _owa_s);
    }());*/
    //]]>
    </script>
    <!-- End Open Web Analytics Code -->
</head>
<link rel="shortcut icon" href="/engstd/favicon.ico">
<style>

.dropdown-menu {
   /*background-color: #33aa33;*/
   
}
.navbar .nav > li > .dropdown-menu:after {
  /*border-bottom: 6px solid #33aa33;*/
}
.dropdown-menu > li > a {
  /*color: white;*/

}
.dropdown-menu > li > a:hover {
  background-color: white;
  
}

.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus,
.dropdown-submenu:hover > a,
.dropdown-submenu:focus > a {
  color: #ffffff;
  text-decoration: none;
  background-color: #62c462;
  background-image: -moz-linear-gradient(top, #62c462, #51a351);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
  background-image: -webkit-linear-gradient(top, #62c462, #51a351);
  background-image: -o-linear-gradient(top,  #62c462, #51a351);
  background-image: linear-gradient(to bottom ,#62c462, #51a351);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
}

.dropdown-menu > .active > a,
.dropdown-menu > .active > a:hover,
.dropdown-menu > .active > a:focus {
  color: #ffffff;
  text-decoration: none;
  background-color: #62c462;
  background-image: -moz-linear-gradient(top, #62c462, #51a351);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
  background-image: -webkit-linear-gradient(top, #62c462, #51a351);
  background-image: -o-linear-gradient(top,  #62c462, #51a351);
  background-image: linear-gradient(to bottom ,#62c462, #51a351);
  background-repeat: repeat-x;
  outline: 0;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
}

.navbar .brand {
display: block;
float: left;
padding: 10px 20px 10px;
/*margin-left: -20px;*/
font-size: 20px;
font-weight: 200;
color: #fff;
text-shadow: 0 0 0 #ffffff;
}        

        
.navbar .nav > li > a{
float: none;
padding: 20px 15px 10px;
color: #fff;
text-decoration: none;
text-shadow: 0 0 0 #ffffff;
height: 35px;
}       

.navbar .nav > li > a >  i{
float: none;
/*margin-top: 5px;*/
}

.navbar .btn, .navbar .btn-group {
   /*margin-top: 15px;*/
}
.navbar .nav  > li > a:hover, .nav > li > a:focus {
    float: none;
    /*padding: 20px 15px 10px;*/
    color: #fff;
    text-decoration: none;
    text-shadow: 0 0 0 #ffffff;
    background-color: #33aa33;
}
.navbar .nav  > .active > a, .navbar .nav > .active > a:hover, .navbar .nav > .active > a:focus {
    color: #ffffff;
    background-color: #499249;

}       
 .navbar-inner {
	background-color:#229922;
    color:#ffffff;
  	border-radius:0;
}
  
.navbar-inner .navbar-nav > li > a {
  	color:#fff;
  	padding-left:20px;
  	padding-right:20px;
}
.navbar-inner .navbar-nav > .active > a, .navbar-nav > .active > a:hover, .navbar-nav > .active > a:focus {
    color: #ffffff;
     background-color: #33aa33;
	background-color:transparent;
}
      
.navbar-inner .navbar-nav > li > a:hover, .nav > li > a:focus {
    text-decoration: none;
    background-color: #33aa33;
}
      
.navbar-inner .navbar-brand {
  	color:#eeeeee;
}
.navbar-inner .navbar-toggle {
  	background-color:#eeeeee;
}
.navbar-inner .icon-bar {
  	background-color:#33aa33;
}

.nav .open>a, .nav .open>a:hover, .nav .open>a:focus {
	background-color: #33aa33;
	border-color: #428bca;
}

.navbar-inner {
    min-height: 0px;
}

.navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle {
  color: white;  
  background-color: #33aa33;
  border-color: #428bca;
}

nav .badge {
  background: #67c1ef;
  border-color: #30aae9;
  background-image: -webkit-linear-gradient(top, #acddf6, #67c1ef);
  background-image: -moz-linear-gradient(top, #acddf6, #67c1ef);
  background-image: -o-linear-gradient(top, #acddf6, #67c1ef);
  background-image: linear-gradient(to bottom, #acddf6, #67c1ef);
}

nav .badge.green {
  background: #77cc51;
  border-color: #59ad33;
  background-image: -webkit-linear-gradient(top, #a5dd8c, #77cc51);
  background-image: -moz-linear-gradient(top, #a5dd8c, #77cc51);
  background-image: -o-linear-gradient(top, #a5dd8c, #77cc51);
  background-image: linear-gradient(to bottom, #a5dd8c, #77cc51);
}

nav .badge.yellow {
  background: #faba3e;
  border-color: #f4a306;
  background-image: -webkit-linear-gradient(top, #fcd589, #faba3e);
  background-image: -moz-linear-gradient(top, #fcd589, #faba3e);
  background-image: -o-linear-gradient(top, #fcd589, #faba3e);
  background-image: linear-gradient(to bottom, #fcd589, #faba3e);
}

nav .badge.red {
  background: #fa623f;
  border-color: #fa5a35;
  background-image: -webkit-linear-gradient(top, #fc9f8a, #fa623f);
  background-image: -moz-linear-gradient(top, #fc9f8a, #fa623f);
  background-image: -o-linear-gradient(top, #fc9f8a, #fa623f);
  background-image: linear-gradient(to bottom, #fc9f8a, #fa623f);
}


@font-face {
    font-family: 'Boon400';
    src: url('/engstd/fonts/boon-400.eot');
    src: url('/engstd/fonts/boon-400.eot') format('embedded-opentype'),
         url('/engstd/fonts/boon-400.woff') format('woff'),
         url('/engstd/fonts/boon-400.ttf') format('truetype'),
         url('/engstd/fonts/boon-400.svg#Boon400') format('svg');
}

@font-face {
    font-family: 'Boon700';
    src: url('/engstd/fonts/boon-700.eot');
    src: url('/engstd/fonts/boon-700.eot') format('embedded-opentype'),
         url('/engstd/fonts/boon-700.woff') format('woff'),
         url('/engstd/fonts/boon-700.ttf') format('truetype'),
         url('/engstd/fonts/boon-700.svg#Boon700') format('svg');
}

@font-face {
    font-family: 'THSarabunPSK';
    src: url('/engstd/fonts/thsarabunnew-webfont.eot');
    src: url('/engstd/fonts/thsarabunnew-webfont.eot') format('embedded-opentype'),
         url('/engstd/fonts/thsarabunnew-webfont.woff') format('woff'),
         url('/engstd/fonts/thsarabunnew-webfont.ttf') format('truetype');
       
}

body{
    
    
     width:100%;
     /*min-height:340px;*/
      height: 100%;
     position: relative;
     /*background: url(../images/intro-bg.jpg) no-repeat center center;*/
     background-size: cover;
     font: 14px/1.4em 'Boon400',sans-serif;
     font-weight: normal;
     padding-bottom: 30px;
}

input, select, textarea {
font-family: 'Boon400', sans-serif;
}

h1,h2,h3,h4{
        font-family: 'Boon700',sans-serif;
        font-weight: normal;
}

table tr .tr_white {
  background-color: #ffffff;
}

#footer {
    background-color: #F0EFEF;
}
.credit {
    margin: 6px 0;
    color: #6a686b;
    text-align: center;
}
#wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        /*margin: 0 auto -60px;*/
}

</style>     
     
<body class="body">

<?php 
 //echo Yii::app()->theme->getBaseUrl(); 


if(!Yii::app()->user->isGuest)
{
  
 

   $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed'=>'top',
    'collapse'=>true,    
    'htmlOptions'=>array('class'=>'noPrint'),
    //'brand' =>  CHtml::image(Yii::app()->getBaseUrl() . '../images/pea_logo.png', 'Logo', array('width' => '220', 'height' => '30')),
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>false,
            'items'=>array(
                //array('label'=>'หน้าแรก','icon'=>'home', 'url'=>array('/site/index')),
               
              ),
        ),    
        array(
            'class'=>'bootstrap.widgets.TbButtonGroup',           
            'htmlOptions'=>array('class'=>'pull-right'),
            'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons'=>array(
                    //array('label'=>Yii::app()->user->title.Yii::app()->user->firstname." ".Yii::app()->user->lastname,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    array('label'=>Yii::app()->user->name,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    //array('label'=>Yii::app()->user->username,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    array('items'=>array(
                        array('label'=>'เปลี่ยนรหัสผ่าน','icon'=>'cog', 'url'=>array('/user/password/'.Yii::app()->user->ID), 'visible'=>!Yii::app()->user->isGuest()),
                        '---',
                        array('label'=>'ออกจากระบบ','icon'=>'off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                ),
            
        ),
        ),
    ));
}
else if(Yii::app()->user->isAdmin())
{
    
   $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed'=>'top',
    'collapse'=>true,    
    'htmlOptions'=>array('class'=>'noPrint'),
    'brand' =>  CHtml::image(Yii::app()->getBaseUrl() . '../images/pea_logo.png', 'Logo', array('width' => '260', 'height' => '30')),
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'รายชื่อผู้เข้ารับบริการ','icon'=>'user', 'url'=>array('/treatmentRecord/indexDoctor'), 'visible'=>Yii::app()->user->isDoctor()),
              
            ),
        ),    
        array(
            'class'=>'bootstrap.widgets.TbButtonGroup',           
            'htmlOptions'=>array('class'=>'pull-right'),
            'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons'=>array(
                    array('label'=>Yii::app()->user->title.Yii::app()->user->firstname."   ".Yii::app()->user->lastname,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    array('items'=>array(
                        array('label'=>'เปลี่ยนรหัสผ่าน','icon'=>'cog', 'url'=>array('/user/password/'.Yii::app()->user->ID), 'visible'=>!Yii::app()->user->isGuest),
                        '---',
                        array('label'=>'ออกจากระบบ','icon'=>'off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                ),
            
        ),
        ),
    ));
    
}
else{
    $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed'=>'top',
    'collapse'=>true,    
    'htmlOptions'=>array('class'=>'noprint'),
    //'brand' =>  CHtml::image(Yii::app()->getBaseUrl() . '../images/pea_logo.png', 'Logo', array('width' => '260', 'height' => '30')),
   
    ));
}   
 
   ?>
<div id="wrap">
    <div class="container" id="page" >

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; 

// if(Yii::app()->user->isGuest())
// echo "guest";
  ?>

	<div class="clear"></div>


</div><!-- page -->
</div>


<div class="navbar navbar-fixed-bottom">
    <div class="navbar-inner" style="background-color: #eeeeee;">
        <div class="width-constraint clearfix">
             <p class="muted credit">พัฒนาโดย กองพัฒนาระบบงานผลิตและวิศวกรรม ฝ่ายพัฒนาและสนับสนุนเทคโนโลยี การประปานครหลวง</p>
     
        </div>
    </div>
</div>
</body>

</html>
