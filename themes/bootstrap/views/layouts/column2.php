<?php /* @var $this Controller */ 
Yii::app()->bootstrap->init();
?>
<?php $this->beginContent('//layouts/main'); ?>
<script type="text/javascript">
    $(function() {

         $('.tree-toggle').click(function () {
        
            $(this).parent().children('ul.tree').toggle(200);
        });
    });

   
</script>

<style type="text/css">
    .nav-header {
        font-size: 16px;
    }
</style>

<?php

if(!Yii::app()->user->isGuest)
{

?>
<div class="row">
   
    <div class="span3">
      <div class="well">
        <div>
            <ul class="nav nav-list">
        <?php
          
            // $this->widget('bootstrap.widgets.TbMenu', array(
            //     'items'=>array(
            //         array('label' => 'Home', 'url' => '#', 'active' => true),
            //         array('label' => 'Link', 'url' => '#'),
            //         ),
            //     'htmlOptions'=>array('class'=>'well'),
            // ));
            $menugroups = MenuGroup::model()->findAll();
            foreach ($menugroups as $key => $group) {
                $menutrees = MenuTree::model()->findAll(array('order'=>'', 'condition'=>'parent_id=:gid', 'params'=>array(':gid'=>$group->id)));
                echo  '<li><label class="tree-toggle nav-header">'.$group->title.'</label>';
                echo  '<ul class="nav nav-list tree">';
                foreach ($menutrees as $key => $menu) {
                    echo ' <li><a href="../'.$menu->url.'">'.$menu->title.'</a></li>';
                }
                echo '</ul>';
            }
            
           
        ?>
            </ul>
        </div>
      </div><!-- well -->

   

   
    </div>


     <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>
<?php 
}
?>

<?php $this->endContent(); ?>


