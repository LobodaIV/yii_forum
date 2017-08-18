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
                    <?php if(Yii::app()->user->hasFlash('authRequired')):?>
                    <div class="authRequired" style="display: none">
                      <?php echo Yii::app()->user->getFlash('authRequired'); ?>
                    </div>
                    <?php endif; ?> 
                    <ul class="topics">
                    <?php foreach($topics as $topic): ?>
                        <li class="topic">
                          <div class="row">
                            <div class="col-md-2">
                               <img src="<?php echo Yii::app()->theme->baseUrl."/images/avatars/". $topic['avatar']?>" 
                              alt="" class="avatar pull-left">
                            </div>
                            <div class="col-md-10">
                              <div class="topic-content pull-right">
                                <h3>
                                <a href="/topic/view/<?php echo CHtml::encode($topic['topic_id'])?>">
                                  <?php echo CHtml::encode($topic['topic_title']) ?>
                                </a>
                                </h3>
                                <div class="topic-info">
                                  <mark><?php echo $topic['category_name']?></mark>
                                  &nbsp;>>&nbsp;
                                  <mark><?php echo $topic['username'] ?></mark>
                                  &nbsp;>>&nbsp;
                                  Posted on: <?php echo date("F j h:m", strtotime($topic['create_date']))?>
                                  <?php foreach($replies as $reply): ?>
                                    <?php if ($topic['topic_title'] == $reply['topic_title']): ?>
                                      <span class="badge pull-rig"><?php echo $reply['replies_in_topic']?></span>
                                    <?php endif; ?>
                                  <?php endforeach; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                    <?php endforeach; ?>                     
                    </ul>
        
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

                      <?php $this->widget("ext.ForumStatisticsWidget") ?>
                    
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
            <script>
            $(document).ready(function() {
              if ($(".authRequired").html().length > 0) {
                alert($(".authRequired").html());
              }
            });
            </script>