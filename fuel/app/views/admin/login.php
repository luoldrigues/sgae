<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>SGAE :: <?php echo $title; ?></title>
    <base href="<?php echo Uri::base(false); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css('main.css'); ?>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('bootstrap-responsive.css'); ?>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body style="margin-top:60px;">
<div class="container">

    <?php
        if(isset($message)){
            echo '<div class="alert alert-error fade in" id="erro"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.$message.'</strong>.</div>';
        }
    ?>

  <form class="form-signin" action="<?php echo Uri::current(); ?>" method="POST">
    <h2 class="form-signin-heading"><?php echo $title; ?> :: Administrador</h2>
    <input type="text" name="username" class="input-block-level" placeholder="Usuário" required pattern="\w{6,}">
    <input type="password" name="password" class="input-block-level" placeholder="Senha" required pattern="\w{6,}">
    <button class="btn btn-large btn-primary" type="submit">Login</button>
  </form>

</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>
</body>
</html>