            <div class="col-md-8">
                <div class="main-col">
                  <div class="block">
                    <h1 class="pull-left">
                      Create Account
                    </h1>
                    <h4 class="pull-right">
                      Simple php forum
                    </h4>
                    <div class="clearfix"></div>
                    <hr>
                    <?php if ($user->hasErrors()): ?>
                    <?php echo CHtml::errorSummary($user) ?>
                    <?php endif; ?>
                    <?php echo CHtml::beginForm("/user/new", "post", array("enctype" => "multipart/form-data"))?>
                      <div class="form-group">
                        <?php echo CHtml::label("Full Name", "User[name]") ?>
                        <?php echo CHtml::textField("User[name]","",array("class" => "form-control")) ?>
                      </div>
                      <div class="form-group">
                        <?php echo CHtml::label("Username", "User[username]") ?>
                        <?php echo CHtml::textField("User[username]","",array("class" => "form-control")) ?>
                      </div>
                      <div class="form-group">
                        <?php echo CHtml::label("Email", "User[email]") ?>
                        <?php echo CHtml::textField("User[email]","",array("class" => "form-control")) ?>
                      </div>
                      <div class="form-group">
                        <?php echo CHtml::label("Password", "User[password]") ?>
                        <?php echo CHtml::passwordField("User[password]","",array("class" => "form-control")) ?>
                      </div>
                       <div class="form-group">
                        <?php echo CHtml::label("Confirm Password", "User[password2]") ?>
                        <?php echo CHtml::passwordField("User[password2]","",array("class" => "form-control")) ?>
                      </div>
                      <div class="form-group">
                        <?php echo CHtml::label("About", "User[about]") ?>
                        <?php echo CHtml::textField("about","",array("class" => "form-control")) ?>
                      </div>
                      <div><?php echo CHtml::hiddenField("User[role]","a")?></div>
                      <div class="form-group">
                        <?php echo CHtml::label("Avatar", "User[avatar]") ?>
                        <?php echo CHtml::fileField("User[avatar]")?>
                      </div>
                      <?php echo CHtml::htmlButton("Register",array("class"=>"btn btn-primary","type"=>"submit")); ?>  
                    <?php echo CHtml::endForm(); ?>

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