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
                    <div class="jumbotron">
                    Hello and Wellcome to our forum. You'll be redirected 
                    to main page in 10 seconds.
                    See you!
                    </div>
                    <div id="secondsDisplay"></div>
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
              window.seconds = 10; 
              window.onload = function()
              {
                if (window.seconds != 0)
              {
                document.getElementById('secondsDisplay').innerHTML = '' +
                window.seconds + ' second' + ((window.seconds > 1) ? 's' : ''); 
                window.seconds--;
                setTimeout(window.onload, 1000);
              }
              else
              {
                window.location = '/';
              }
            }
            </script>