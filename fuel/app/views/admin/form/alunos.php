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
    <?php echo Asset::css('bootstrap-select.min.css'); ?>
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
        <input class="span4" type="text" name="nome" id="nome" required placeholder="Nome do Aluno" <?php if(isset($aluno['nome'])){ echo 'value="'.$aluno['nome'].'"'; }?>>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="nome">RA*</label>
      <div class="controls">
        <input class="span4" type="number" name="ra" id="ra" required placeholder="RA do Aluno" <?php if(isset($aluno['ra'])){ echo 'value="'.$aluno['ra'].'"'; }?>>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Nome">Curso*</label>
      <div class="controls">
        <select class="span4" name="idCurso" id="idCurso">
          <?php
            if(isset($cursos) AND is_array($cursos)){
              foreach ($cursos AS $k => $curso) {
                  $select = null;
                  if(isset($aluno_curso)){ if(in_array($curso['idCurso'], $aluno_curso)){   $select = 'selected';   } }
                  echo '<option value="'.$curso['idCurso'].'" '.$select.'>'.$curso['nome'].'</option>';
              }
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="email">Email*</label>
      <div class="controls">
        <input class="span4" type="email" required name="email" id="email" <?php if(isset($aluno['email'])){ echo 'value="'.$aluno['email'].'"'; }?>>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="NovaSenha">Aterar Senha</label>
      <div class="controls">
        <input class="span3" type="text" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" name="senha" id="NovaSenha">
        <span class="ttp" style="cursor:pointer" title="Preencha se quiser alterar a senha do aluno. A senha deve conter letras maiúsculas, minúculas e letras."> (?) </span>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn">Atualizar</button>
      </div>
    </div>
  </form>

</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>
<?php echo Asset::js('bootstrap-select.min.js'); ?>
<?php echo Asset::js('bootstrap-validation.js'); ?>

<script>
$(document).ready(function(){
  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  $('.ttp').tooltip();
  $('select').selectpicker();
})
</script>
</body>
</html>