            <div class="col-md-8">
                <div class="main-col">
                  <div class="block">
                    <h1 class="pull-left">
                      Category management | +&nbsp;<?php echo CHtml::link("Add Category","/category/create")?>
                    </h1>
                    <h4 class="pull-right">
                      Simple php forum
                    </h4>
                    <div class="clearfix"></div>
                    <hr>
                    <p id="category_created" class="alert alert-success" style="display:none"><?php echo Yii::app()->user->getFlash('success')?></p>
                    <table class="table table-hover">
                      <thead>
                        <th>ID</th>
                        <th>Category title</th>
                        <th>Description</th>
                        <th>Slug</th>
                      </thead>
                      <tbody>
                      <?php foreach($categories as $category): ?>
                        <tr>
                          <td><?php echo $category['category_id'] ?></td>
                          <td><?php echo $category['name'] ?></td>
                          <td><?php echo $category['description'] ?></td>
                          <td><?php echo $category['slug']?></td>
                          <td>
                          <a href="/category/delete/<?php echo $category['slug']?>" class="btn btn-danger">
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