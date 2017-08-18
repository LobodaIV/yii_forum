            <div class="col-md-8">
                <div class="main-col">
                  <div class="block">
                    <h1 class="pull-left">
                      Topics management
                    </h1>
                    <h4 class="pull-right">
                      Simple php forum
                    </h4>
                    <div class="clearfix"></div>
                    <hr>
                    <p id="topic_created" class="alert alert-success" style="display:none"><?php echo Yii::app()->user->getFlash('success')?></p>
                    <table class="table table-hover">
                      <thead>
                        <th>ID</th>
                        <th>User</th>
                        <th>Title</th>
                        <th>Create Date</th>
                      </thead>
                      <tbody>
                      <?php foreach($topics as $topic): ?>
                        <tr>
                          <td><?php echo $topic['topic_id'] ?></td>
                          <td><?php echo $topic['username'] ?></td>
                          <td><?php echo $topic['title'] ?></td>
                          <td><?php echo $topic['create_date']?></td>
                          <td>
                          <a href="/topic/edit/<?php echo $topic['topic_id']?>" class="btn btn-info">
                              <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                          <a href="/topic/delete/<?php echo $topic['topic_id']?>" class="btn btn-danger">
                              <span class="glyphicon glyphicon-remove"></span>
                          </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>

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

              var msg = $("#topic_created");
              if (msg.html().length > 0) {
                msg.css("display","block");
                msg.hide(2500);
              }

            });
            </script>