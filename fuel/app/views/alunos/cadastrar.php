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

<div class="container">
<h2 align="center" style="margin:25px;">Cadastro de Aluno</h2>

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

  <form class="form-horizontal" action="<?php echo Uri::current(); ?>" method="POST">
    <div class="control-group">
      <label class="control-label" for="nome">Nome*</label>
      <div class="controls">
        <input class="span4" type="text" name="nome" id="nome" required placeholder="Digite seu Aluno">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="nome">RA*</label>
      <div class="controls">
        <input class="span4" type="number" name="ra" id="ra" required placeholder="Digite seu RA">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Nome">Curso*</label>
      <div class="controls">
        <select class="span4" name="idCurso" id="idCurso">
          <?php
            if(isset($cursos) AND is_array($cursos)){
              foreach ($cursos AS $k => $curso) {
                  echo '<option value="'.$curso['idCurso'].'">'.$curso['nome'].'</option>';
              }
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="email">Email*</label>
      <div class="controls">
        <input class="span4" type="email" name="email" id="email" required>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="confirmaemail">Confirmação do Email*</label>
      <div class="controls">
        <input class="span4" type="email" data-validation-matches-match="email" name="confirmaemail" id="confirmaemail" required>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="senha">Senha*</label>
      <div class="controls">
        <input class="span3" type="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" name="senha" id="senha" required>
        <span class="ttp" style="cursor:pointer" title="A senha deve conter letras maiúsculas, minúculas e letras"> (?) </span>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="confirmasenha">Confirmação de Senha*</label>
      <div class="controls">
        <input class="span3" type="password" data-validation-matches-match="senha" name="confirmasenha" id="confirmasenha" required>
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
<?php echo Asset::js('bootstrap-select.min.js'); ?>
<?php echo Asset::js('bootstrap-validation.js'); ?>

<script>
$(document).ready(function(){
  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  $('select').selectpicker();
  $('.ttp').tooltip();
})
</script>
</body>
</html>