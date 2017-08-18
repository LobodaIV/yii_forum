            <div class="col-md-8">
              <div class="main-col">
                  <div class="block">
                    <h1 class="pull-left">
                      Welcome to Yii forum
                    </h1>
                    <h4 class="pull-right">
                      Simple php forum
                    </h4>
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="topics">
                      <li class="main-topic">
                        <div class="row">
                          <div class="col-md-2">
                           <div class="user-info">
                              <img src="<?php echo Yii::app()->theme->baseUrl."/images/avatars/".$user['avatar']?>" class="avatar pull-left">
                              <ul>
                                <li><strong><?php echo $user['username']?></strong></li>
                                <li><strong>43 Posts</strong></li>
                                <li><a href="#">Profile</a></li>
                              </ul>
                            </div>
                          </div><!-- ./col-md-2 -->
                          <div class="col-md-10">
                            <div class="topic-content pull-right">
                              <p><?php echo $topic['body']?></p>
                            </div>
                          </div><!-- end of col-md-10 -->
                        </div><!-- ./row insde .topic -->
                      </li><!--end of topic -->
                      <hr>
                    </ul><!-- ./topics -->
                    <!-- Replies to topic -->
                    <ul class="topics">
                    <?php foreach ($replies as $reply) : ?>
                      <li>
                        <div class="row">
                          <div class="col-md-2">
                           <div class="user-info">
                              <img src="<?php echo Yii::app()->theme->baseUrl."/images/avatars/".$reply['avatar']?>" class="avatar pull-left">
                              <ul>
                                <li><strong><?php echo $reply['username']?></strong></li>
                                <li><strong>43 Posts</strong></li>
                                <li><a href="#">Profile</a></li>
                              </ul>
                            </div>
                          </div><!-- ./col-md-2 -->
                          <div class="col-md-10">
                            <div class="topic-content pull-right">
                              <p><?php echo $reply['body']?></p>
                            </div>
                          </div><!-- end of col-md-10 -->
                        </div><!-- ./row insde .topic -->
                      </li><!--end of topic -->
                      <hr>
                    </ul><!-- ./replies -->
                  <?php endforeach; ?>
                    <?php if(Yii::app()->user->isGuest): ?>
                          <p>You can't reply to the topic because unauthorized</p>
                    <?php else: ?>
                      <?php echo CHtml::errorSummary($mReply) ?>
                      <h3>Reply to Topic</h3>
                      <?php echo CHtml::beginForm("/topic/reply/" . $topic['topic_id'])?>
                        <?php echo CHtml::hiddenField("topic_id",$topic['topic_id']) ?>
                        <?php echo CHtml::hiddenField("user_id",Yii::app()->user->getId()) ?>
                        <div class="form-group">
                        <?php $this->widget('ext.TheCKEditorWidget',array(
                        'model'=> $mReply,                # Data-Model (form model)
                        'name'=> 'body',         # Attribute in the Data-Model
                        'height'=>'200px',
                        'width'=>'100%',
                        'toolbarSet'=>'Basic',          # EXISTING(!) Toolbar (see: ckeditor.js)
                        'ckeditor'=>Yii::app()->theme->baseUrl .'/assets/js/ckeditor/ckeditor.php',
                                                        # Path to ckeditor.php
                        'ckBasePath'=>Yii::app()->theme->baseUrl .'/assets/js/ckeditor/',
                                      # Relative Path to the Editor (from Web-Root)
                                      # Additional Parameters
                          ) ); ?>
                          
                        </div>

                        <?php echo CHtml::htmlButton("Reply",array("class"=>"btn btn-primary","type"=>"submit")); ?>
                      <?php echo CHtml::endForm()?>
                      <?php endif; ?>
                      <?php if ($pagination->pageCount > 1) { ?>
                      <?php
                        $this->widget('CLinkPager', 
                          array(
                            'pages' => $pagination,
                            'internalPageCssClass' => '',
                            'id' => '',
                            'header' => '',
                            'selectedPageCssClass' => 'active',
                            'hiddenPageCssClass' => 'disabled',
                            'nextPageLabel' => '&raquo;',         // »
                            'prevPageLabel' => '&laquo;',         // «
                            'lastPageLabel' => '&raquo;&raquo;',  // »»
                            'firstPageLabel' => '&laquo;&laquo;', // ««
                            'htmlOptions' => array('class' => 'pagination'),
                        ));
                      ?>
                      <?php } ?>

                    </div>
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
            <?php endif; ?><!-- ./col-md-4 -->