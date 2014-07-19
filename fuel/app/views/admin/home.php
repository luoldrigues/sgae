<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>SGAE :: <?php echo $title; ?></title>
    <base href="<?php echo Uri::base(false); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css('main.css'); ?>
    <?php echo Asset::css('bootstrap.min.css'); ?>
    <?php echo Asset::css('bootstrap-responsive.min.css'); ?>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body class="body">

<?php echo $menu; ?>

<div class="container">

<?php
    if(isset($message)){
        if(!isset($msgtype) OR $msgtype != 'success'){
          $msgtype = 'error';
        }
        if(is_array($message)){
            foreach ($message as $msg) {
                echo '<div class="alert alert-'.$msgtype.' fade in" id="'.$msgtype.'"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.$msg.'</strong></div>';
            }
        }else{
            echo '<div class="alert alert-'.$msgtype.' fade in" id="'.$msgtype.'"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.html_entity_decode($message).'</strong></div>';
        }
    }
?>

<div class="my-content-box">
  <div class="title">Bem-vindo!</div>
    <p class="muted" style="margin-bottom: 0;">
    <h4>Bem-vindo ao SGAE (Sistema de Gestão de Atividades Extracurriculares).</h4>
    Qualquer dúvida consulte o <a href="<?php echo URI::base() . 'docs/manual/'; ?>">manual do usuário</a>.
    </p>
    <br />
    <p class="muted" style="margin-bottom: 0;">
    <h5>Este sistema foi desenvolvido por:</h5>
    <ul>
        <li>Karen Galdino</li>
        <li>Laira Adrieli Luciano</li>
        <li>Luan Oliveira Rodrigues</li>
    </ul>
    Alunos do curso Sistemas para Internet :: Turma 2010/2 ~ 2013/2
    </p>

  </div>
</div>


</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>

</body>
</html>