  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forum base on Yii</title>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/style.css" rel="stylesheet">

    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/slug_generator.js"></script>
  </head>

  <body>

    <?php $this->widget("ext.NavBarWidget") ?>

    <div class="container">
        <div class="row">
            <?php echo $content ?>
        </div><!-- ./row -->
    </div><!-- /.container -->

  </body>
</html>