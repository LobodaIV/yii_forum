            <div class="col-md-8">
                <div class="main-col">
                  <div class="block">
                    <h1 class="pull-left">
                      Users management | <?php echo CHtml::link("+Add user","/user/create")?>
                    </h1>
                    <h4 class="pull-right">
                      Simple php forum
                    </h4>
                    <div class="clearfix"></div>
                    <hr>
                    <p id="user_deleted"><?php echo Yii::app()->user->getFlash('success')?></p>
                    <table class="table">
                      <thead>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </thead>
                      <tbody>
                       <?php foreach($users as $user): ?>
                        <tr>
                          <td><?php echo $user['username'] ?></td>
                          <td><?php echo $user['role'] ?></td>
                          <td>
                          <a href="/user/edit/<?php echo $user['id']?>" class="btn btn-info">
                              <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                          </td>
                          <td>
                          <a href="/user/delete/<?php echo $user['id']?>" class="btn btn-danger">
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

              var msg = $("#user_deleted");
              if (msg.html().length > 0) {
                msg.hide(2000);
              }

            });
            </script>