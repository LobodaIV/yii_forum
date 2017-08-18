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
					<h1 class="well">Topics by slag "<?php echo $slug ?>"</h1>
                    <ul class="topics">
                    	<?php foreach ($topicsInCategory as $topic): ?>
                    		<li><a href="/topic/view/<?php echo $topic['topic_id']?>"><?php echo $topic['title'] ?></a></li>
                    	<?php endforeach; ?>       
                    </ul>


                    <h3>Forum statistics</h3>
                    <ul>
                      <li>Total number of Users: <strong>52</strong></li>
                      <li>Total number of Topics: <strong>10</strong></li>
                      <li>Total number of Categories: <strong>5</strong></li>
                    </ul>

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