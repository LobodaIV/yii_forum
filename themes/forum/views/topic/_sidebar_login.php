                <div class="sidebar">
                  <div class="block">
                    <h3>Login Form</h3>
                    <?php echo CHtml::beginForm("/site/login") ?>
                      <div class="form-group">
                        <?php echo CHtml::activeLabelEx($user,"Username") ?>
                        <?php echo CHtml::activeTextField($user,"username",array("class"=> "form-control", "placeholder" => "Enter Username", "value" => "")) ?>
                        <?php echo CHtml::error($user,"username",array("class" => "bg-danger"));?>
                      </div>
                      
                      <div class="form-group">
                        <?php echo CHtml::activeLabelEx($user,"Password") ?>
                        <?php echo CHtml::activePasswordField($user,"password",array("class"=> "form-control", "placeholder" => "Enter Password", "value" => "")) ?>
                        <?php echo CHtml::error($user,"password",array("class" => "bg-danger"));?>
                      </div>
                      
                      <?php echo CHtml::htmlButton("Login", array("class" => "btn btn-primary", "type" => "submit"))?>
                      <?php echo CHtml::link("Create account", "/user/new",array("class" => "btn btn-primary")) ?>
                    <?php echo CHtml::endForm() ?>
                  </div>
                  <div class="block">
                    <h3>Categories</h3>
                    <ul class="list-group">
                      <?php foreach($categories as $category):?>
                          <li class="list-group-item">
                            <?php echo CHtml::link(
                              $category['name'],
                            "/category/view/{$category['slug']}");
                            ?>
                          </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>

                </div>