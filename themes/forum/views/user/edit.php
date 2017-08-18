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
                    <div id="edit_success"><?php echo Yii::app()->user->getFlash('success') ?></div>
                    <?php echo CHtml::beginForm("/user/edit/" . $user['id'],"POST",array("enctype" => "multipart/form-data")) ?>
                    <table class="table">
                        <tr>
                          <td>Full Name</td>
                          <td>
                          <?php echo CHtml::activeTextField($user,"name",array("class"=>"form-control"))?>  
                          </td>
                        </tr>
                        <tr>
                        <td>Username</td>
                        <td>
                        <?php echo CHtml::activeTextField($user,"username",array("class"=>"form-control"))?>  
                        </td>
                        </tr>
                        <tr>
                        <td>Email</td>
                        <td>
                        <?php echo CHtml::activeTextField($user,"email",array("class"=>"form-control"))?>
                        </td>
                        </tr>
                        <tr>
                          <td>Password</td>
                        <td>
                        <?php echo CHtml::textField("User[password]","",array("class"=>"form-control"))?>
                        </td>
                        </tr>
                        <tr>
                        <td>Role</td>
                        <td>
                          <?php 
                          if(Yii::app()->user->role == "m") {
                          $items = array("a" => "Author","e" => "Editor", "m" => "Administrator");
                          echo CHtml::dropDownList('User[role]',"Author",$items,array("class"=>"form-control"));
                          } else {
                            switch (Yii::app()->user->role) {
                              case 'a':
                                echo "Author";
                                break;
                              case 'e':
                                echo "Editor";
                              default:
                                break;
                            }
                          }
                          ?>
                        </td>
                        </tr>
                        <tr>
                        <td>
                        <?php echo CHtml::activeFileField($user,"avatar")?>
                        </td>
                        </tr>
                        <tr>
                        <td>
                          <?php echo CHtml::htmlButton("Update",array("class"=>"btn btn-primary","type"=>"submit")); ?>  
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

              var msg = $("#edit_success");
              if (msg.html().length > 0) {
                msg.hide(2000);
              }

            });
            </script>