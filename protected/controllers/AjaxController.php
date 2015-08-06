
<?php
class AjaxController extends Controller {


     public function actionGetVendor() {        
    
        
       if( $_POST['workcat_id']!='') 
        $data = Vendor::model()->findAll('type=:id', array(':id' => (int) $_POST['workcat_id']));        
        else    
        $data = Vendor::model()->findAll();        
    
        
        $data = CHtml::listData($data, 'id', 'name');
        
        if(empty($data))
             echo CHtml::tag('option', array('value' => ''), CHtml::encode(""), true);
        else
             echo CHtml::tag('option', array('value' => ''), CHtml::encode("ทั้งหมด"), true);
        foreach ($data as $value => $name) {            
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }


 
 
    
   
}
?>