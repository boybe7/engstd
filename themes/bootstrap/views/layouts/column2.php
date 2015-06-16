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
<div class="row">
   
    <div class="span3">
        <div id="sidebar">
        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Operations',
            ));
            $this->widget('bootstrap.widgets.TbMenu', array(
                'items'=>array(
                    array('label' => 'Home', 'url' => '#', 'active' => true),
                    array('label' => 'Link', 'url' => '#'),
                    ),
                'htmlOptions'=>array('class'=>'well'),
            ));
            $this->endWidget();
        ?>

        <div class="row">
  <div class="span3">
    <div class="well">
        <div>
            <ul class="nav nav-list">
                <li><label class="tree-toggle nav-header">Bootstrap</label>
                    <ul class="nav nav-list tree">
                        <li><a href="#">JavaScript</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><label class="tree-toggle nav-header">Buttons</label>
                            <ul class="nav nav-list tree">
                                <li><a href="#">Colors</a></li>
                                <li><a href="#">Sizes</a></li>
                                <li><label class="tree-toggle nav-header">Forms</label>
                                    <ul class="nav nav-list tree">
                                        <li><a href="#">Horizontal</a></li>
                                        <li><a href="#">Vertical</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li><label class="tree-toggle nav-header">Responsive</label>
                    <ul class="nav nav-list tree">
                        <li><a href="#">Overview</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><label class="tree-toggle nav-header">Media Queries</label>
                            <ul class="nav nav-list tree">
                                <li><a href="#">Text</a></li>
                                <li><a href="#">Images</a></li>
                                <li><label class="tree-toggle nav-header">Mobile Devices</label>
                                    <ul class="nav nav-list tree">
                                        <li><a href="#">iPhone</a></li>
                                        <li><a href="#">Samsung</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><label class="tree-toggle nav-header">Coding</label>
                            <ul class="nav nav-list tree">
                                <li><a href="#">JavaScript</a></li>
                                <li><a href="#">jQuery</a></li>
                                <li><label class="tree-toggle nav-header">HTML DOM</label>
                                    <ul class="nav nav-list tree">
                                        <li><a href="#">DOM Elements</a></li>
                                        <li><a href="#">Recursive</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    </div>
        </div><!-- sidebar -->
    </div>


     <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>
<?php $this->endContent(); ?>