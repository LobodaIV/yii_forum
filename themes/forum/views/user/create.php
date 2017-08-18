            <div class="col-md-8">
                <div class="main-col">
                  <div class="block">
                    <h1 class="pull-left">
                      Users management
                    </h1>
                    <h4 class="pull-right">
                      Simple php forum
                    </h4>
                    <div class="clearfix"></div>
                    <p id="user_created"><?php echo Yii::app()->user->getFlash('success')?></p>
                    <?php echo CHtml::beginForm("/user/create","POST",array("enctype" => "multipart/form-data")) ?>
                    <table class="table">
                        <?php if ($user->hasErrors()): ?>
                          <?php echo CHtml::errorSummary($user) ?>
                        <?php endif; ?>
                        <tr>
                          <td>Full Name</td>
                          <td>
                          <?php echo CHtml::textField("name","",array("class"=>"form-control"))?>
                          </td>
                        </tr>
                        <tr>
                        <td>Username</td>
                        <td>
                        <?php echo CHtml::textField("username","",array("class"=>"form-control"))?>  
                        </td>
                        </tr>
                        <tr>
                        <td>Email</td>
                        <td>
                        <?php echo CHtml::textField("email","",array("class"=>"form-control"))?>
                        </td>
                        </tr>
                        <tr>
                          <td>Password</td>
                        <td>
                        <?php echo CHtml::passwordField("password","",array("class"=>"form-control"))?>
                        </td>
                        </tr>
                        <tr>
                        <td>Role</td>
                        <td>
                          <?php 
                          $items = array("a" => "Author","e" => "Editor");
                          echo CHtml::dropDownList('role',"Author",$items,array("class"=>"form-control"));
                          ?>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <?php echo CHtml::fileField("avatar")?>
                        </td>
                        <td><p class="help-field">Please select avatar image</p></td>
                        </tr>
                        <tr>
                        <td>
                          <?php echo CHtml::htmlButton("Create",array("class"=>"btn btn-primary","type"=>"submit")); ?>  
                         </td>
                         </tr>
                    </table>
                    <?php echo CHtml::endForm() ?>
                  </div><!-- ./block -->
                </div><!-- ./main-col -->
            </div><!-- ./col-md-8 -->

            <div class="col-md-4">
               <?php if (Yii::app()->user->isGuest):?>
                <?php $this->renderPartial('_sidebar_login',array(
                  'categories' => $categories,
                  'user' => $user,
                )); ?>
                <?php else: ?>
                <?php $this->renderPartial('_sidebar_loggedin',array(
                  'categories' => $categories
                )); ?>
                <?php endif; ?>
            </div><!-- ./col-md-4 -->
            <script>
            $(document).ready(function() {

              var msg = $("#user_created");
              if (msg.html().length > 0) {
                msg.hide(2000);
              }

            });
            </script>