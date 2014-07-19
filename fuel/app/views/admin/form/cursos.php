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

  <form class="form-horizontal" action="<?php echo Uri::current(); ?>" method="POST">
    <div class="control-group">
      <label class="control-label" for="nome">Nome*</label>
      <div class="controls">
        <input class="span4" type="text" name="nome" id="nome" required placeholder="Nome do Curso" <?php if(isset($curso['nome'])){ echo 'value="'.$curso['nome'].'"'; }?>>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="CargaHoraria">Carga Horária*</label>
      <div class="controls">
        <input style="width:60px" type="number" name="carga_horaria" required min="1" id="CargaHoraria" <?php if(isset($curso['carga_horaria'])){ echo 'value="'.$curso['carga_horaria'].'"'; }?>> horas.
        <span class="ttp" style="cursor:pointer" title="Determina a carga horária mínima de atividades extracurriculares do curso"> (?) </span>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn">Cadastrar</button>
      </div>
    </div>
  </form>

</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>
<?php echo Asset::js('bootstrap-validation.js'); ?>

<script>
$(document).ready(function(){

  $('.ttp').tooltip();
  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

})
</script>

</body>
</html>