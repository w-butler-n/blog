<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href=<?php echo WEBROOT.'css/normalize.css'; ?>>
        <link rel="stylesheet" href=<?php echo WEBROOT.'css/bootstrap.css'; ?>>
        <link rel="stylesheet" href=<?php echo WEBROOT.'css/main.css'; ?>>
        <link rel="stylesheet" href=<?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin'){echo WEBROOT.'css/dasboard.css';}; ?>>
        <link href='http://fonts.googleapis.com/css?family=Sancreek' rel='stylesheet' type='text/css'>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <?php 
                if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin')
                {

                }
                else
                {
                    include('./template/header.php');
                } 
            ?>
        <main class="clearfix">
            <?php echo $content_for_layout; ?>
        </main>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src=<?php echo WEBROOT.'js/plugin.css'; ?>></script>
        <script src=<?php echo WEBROOT.'js/bootstrap.js'; ?>></script>
        <script src=<?php echo WEBROOT.'js/main.js'; ?>></script>
    </body>
</html>