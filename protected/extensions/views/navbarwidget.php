        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <p class="navbar navbar-brand"><?php echo Yii::app()->name;?></p>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><?php echo $this->getLink("Home", "/site/index")?></li>
                <li><?php echo $this->getLink("Create Topic", "/topic/create")?></li>
                <?php if ( (!Yii::app()->user->isGuest) && Yii::app()->user->role == 'm') :?> 
                  <li><?php echo $this->getLink("Topics management", "/topic/list")?></li>
                  <li><?php echo $this->getLink("Accounts management", "/users")?></li>
                  <li><?php echo $this->getLink("Categories management", "/category")?></li> 
                <?php endif; ?>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>