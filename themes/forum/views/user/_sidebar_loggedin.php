                <div class="sidebar">
                  <div class="block">
                  	<h3>User:<?php echo Yii::app()->user->name ?></h3>
                    <h3>About:<?php echo Yii::app()->user->about ?></h3>
                  	<h3>Email:<?php echo Yii::app()->user->email ?></h3>
                    <?php echo CHtml::link("Logout", "/site/logout", array("class" => "btn btn-primary")) ?>
                    <?php echo CHtml::link("Edit", "/user/edit/" . Yii::app()->user->getId(), array("class" => "btn btn-primary")) ?>
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