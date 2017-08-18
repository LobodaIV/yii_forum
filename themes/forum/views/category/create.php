            <div class="col-md-8">
                <div class="main-col">
                  <div class="block">
                    <h1 class="pull-left">
                      Create Category
                    </h1>
                    <h4 class="pull-right">
                      Simple php forum
                    </h4>
                    <div class="clearfix"></div>
                    <hr>
                    <p class="res" id="res"></p>
                    <p><?php echo Yii::app()->user->getFlash('success')?></p>
                    <?php echo CHtml::beginForm("/category/create","POST") ?>
                      <div class="form-group">
                        <?php echo CHtml::activeLabelEx($category,"name");?>
                        <?php echo CHtml::activeTextField($category,"name",array("class"=>"form-control","placeholder"=>"Category name", "id" => "source"));?>
                        <?php echo CHtml::error($category, "name") ?>
                      </div>
                      <div class="form-group">
                        <?php echo CHtml::activeLabelEx($category,"description");?>
                        <?php echo CHtml::activeTextField($category,"description",array("class"=>"form-control","placeholder"=>"Description"));?>
                        <?php echo CHtml::error($category, "description") ?>
                      </div>    
                      <div class="form-group">
                        <?php echo CHtml::activeLabelEx($category,"slug");?>
                        <?php echo CHtml::activeTextField($category,"slug",array("class"=>"form-control","placeholder"=>"Slug", "id" => "destination"));?>
                        <?php echo CHtml::error($category, "Slug") ?>
                      </div>
                      <?php echo CHtml::hiddenField("ajax","ajax")?>
                      <?php echo CHtml::ajaxSubmitButton("Create",
                      CHtml::normalizeUrl(array('/category/create')),
                      array(
                        'dataType'=>'json',
                        'type'=> 'post',
                        'success' => 'function(data) {
                          
                          
                          try {
                            var json = JSON.parse(data);
                            $(json).each(function(i,val) {
                              $.each(val,function(k,v) {
                                    $("#res").append("<p id=\'err\'>" + v + "</p>");
                              });
                            });

                          } catch(e) {
                            if (data.status == "success") {
                              alert("Category has been created");
                            }
                          }

                            $("#res").children().hide(3000, function() {
                                $(this).empty();
                            });
                            

                        }',
                        'error' => 'function(data) {
                            if (data.status == 500) {
                              alert("You are trying to create category which already exists or server can\'t respond at the moment!");
                            }
                        }'
                      ),
                      array("class"=>"btn btn-primary"));
                      ?>
                    <?php echo CHtml::endForm() ?>

                  </div><!-- ./block -->
                </div><!-- ./main-col -->
            </div><!-- ./col-md-8 -->
            <div class="col-md-4">
                <?php $this->renderPartial('_sidebar_loggedin',array(
                  'categories' => $categories
                )); ?>
            </div><!-- ./col-md-4 -->
