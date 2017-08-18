            <div class="col-md-8">
                <div class="main-col">
                  <div class="block">
                    <h1 class="pull-left">
                      Create Topic
                    </h1>
                    <h4 class="pull-right">
                      Simple php forum
                    </h4>
                    <div class="clearfix"></div>
                    <hr>
                    <p><?php echo Yii::app()->user->getFlash('success')?></p>
                    <?php echo CHtml::beginForm() ?>
                      <div class="form-group">
                        <?php echo CHtml::activeLabelEx($topic,"title");?>
                        <?php echo CHtml::activeTextField($topic,"title",array("class"=>"form-control","placeholder"=>"Topic Title"));?>
                        <?php echo CHtml::error($topic, "title") ?>
                      </div>
                      <div class="form-group">
                        <?php echo CHtml::activeLabelEx($topic,"category")?>
                        <?php 
                          $listData = CHtml::encodeArray(
                          CHtml::listData($categories,"category_id","name"))
                        ?>
                        <?php echo CHtml::activeDropDownList($topic,"category_id",$listData)?>
                      </div>
                      <?php echo CHtml::activeHiddenField($topic,"user_id",array("value" => Yii::app()->user->getId()))?>
                      <?php echo CHtml::error($topic, "body") ?>
                      <div class="form-group">
                        <?php echo CHtml::activeLabelEx($topic, "body") ?>
                      
                      <?php $this->widget('ext.TheCKEditorWidget',array(
                      'model'=>$topic,                # Data-Model (form model)
                      'attribute'=>'body',         # Attribute in the Data-Model
                      'height'=>'400px',
                      'width'=>'100%',
                      'toolbarSet'=>'Basic',          # EXISTING(!) Toolbar (see: ckeditor.js)
                      'ckeditor'=>Yii::app()->theme->baseUrl .'/assets/js/ckeditor/ckeditor.php',
                                                      # Path to ckeditor.php
                      'ckBasePath'=>Yii::app()->theme->baseUrl .'/assets/js/ckeditor/',
                                    # Relative Path to the Editor (from Web-Root)
                                    # Additional Parameters
                        ) ); ?>

            
                      </div>

                    <?php echo CHtml::htmlButton("Create",array("class"=>"btn btn-primary","type"=>"submit")); ?>
                    <?php echo CHtml::endForm() ?>

                  </div><!-- ./block -->
                </div><!-- ./main-col -->
            </div><!-- ./col-md-8 -->

            <div class="col-md-4">
                <?php if (Yii::app()->user->isGuest):?>
                <?php $this->renderPartial('_sidebar_login',array(
                  'categories' => $categories, 
                  'user' => $user
                )); ?>
                <?php else: ?>
                <?php $this->renderPartial('_sidebar_loggedin',array(
                  'categories' => $categories
                )); ?>
                <?php endif; ?>
            </div><!-- ./col-md-4 -->