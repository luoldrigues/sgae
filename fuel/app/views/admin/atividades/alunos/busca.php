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

<?php
    if(isset($message)){
      if(!isset($msgtype) OR $msgtype != 'success'){
        $msgtype = 'error';
      }
      if(is_array($message)){
          foreach ($message as $msg) {
              echo '<div class="alert alert-'.$msgtype.' fade in" id="'.$msgtype.'"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.$msg.'</strong>.</div>';
          }
      }else{
      echo '<div class="alert alert-'.$msgtype.' fade in" id="'.$msgtype.'"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.$message.'</strong>.</div>';
      }
    }
?>

<div class="my-content-box">
  <div class="title">Buscar por RA</div>
  <p class="muted" style="margin-bottom: 0;">
  <form class="form-horizontal" action="<?php echo Uri::current(); ?>" method="POST">
    <div class="control-group">
      <label class="control-label" for="ra">RA</label>
      <div class="controls">
        <input class="span4" type="text" name="ra" id="ra" placeholder="Número do RA">
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn">Buscar</button>
      </div>
    </div>
  </form>
  </p>
</div>

<div class="my-content-box">
  <div class="title">Buscar por Curso</div>
  <p class="muted" style="margin-bottom: 0;">
  <form class="form-horizontal" action="<?php echo Uri::current(); ?>" method="POST">
    <div class="control-group">
      <label class="control-label" for="ra">Curso</label>
      <div class="controls">
        <select class="span4" name="idCurso" id="idCurso">
          <option value="0" selected>Nenhum selecionado</option>
          <?php
            if(isset($cursos) AND is_array($cursos)){
              foreach ($cursos AS $k => $curso) {
                  $select = null;
                  if(isset($atividade_curso)){ if(in_array($curso['idCurso'], $atividade_curso)){   $select = 'selected';   } }
                  echo '<option value="'.$curso['idCurso'].'" '.$select.'>'.$curso['nome'].'</option>';
              }
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="ra">Aluno</label>
      <div class="controls">
        <select class="span4" name="idAluno" id="idAluno" disabled></select>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn">Buscar</button>
      </div>
    </div>
  </form>
  </p>
</div>

<div class="my-content-box">
  <div class="title">Cadastrar em Massa</div>
  <p class="muted" style="margin-bottom: 0;">
  <form class="form-horizontal" action="<?php echo Uri::current(); ?>" method="POST">
    <div class="control-group">
      <label class="control-label" for="ra">Curso</label>
      <div class="controls">
        <select class="span4" name="idCurso" id="idCursoA">
          <option value="0" selected>Nenhum selecionado</option>
          <?php
            if(isset($cursos) AND is_array($cursos)){
              foreach ($cursos AS $k => $curso) {
                  $select = null;
                  if(isset($atividade_curso)){ if(in_array($curso['idCurso'], $atividade_curso)){   $select = 'selected';   } }
                  echo '<option value="'.$curso['idCurso'].'" '.$select.'>'.$curso['nome'].'</option>';
              }
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="ra">Atividade</label>
      <div class="controls">
        <select class="span4" name="idAtividade" id="idAtividade" disabled></select>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn">Buscar</button>
      </div>
    </div>
  </form>
  </p>
</div>

</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>
<?php echo Asset::js('bootstrap-select.min.js'); ?>

<script>
$(document).ready(function(){

  $('#idCurso').on('change', function(){
    var val = $(this).val();
    $.post('<?php echo Uri::base();?>admin/consulta/alunos/',{idCurso:val}, function(data){
      if(data != ''){
        $('#idAluno').prop('disabled', false);
        $('#idAluno').html(data);
        $('#idAluno').selectpicker('refresh');
      }else{
        $('#idAluno').prop('disabled', true);
        $('#idAluno').html('<option>(Nenhum Registro)</option>');
        $('#idAluno').selectpicker('refresh');
      }
    })
  })
  $('#idCursoA').on('change', function(){
    var val = $(this).val();
    $.post('<?php echo Uri::base();?>admin/consulta/atividade_curso/' + val, function(data){
      if(data != ''){
        $('#idAtividade').prop('disabled', false);
        $('#idAtividade').html(data);
        $('#idAtividade').selectpicker('refresh');
      }else{
        $('#idAtividade').prop('disabled', true);
        $('#idAtividade').html('<option>(Nenhum Registro)</option>');
        $('#idAtividade').selectpicker('refresh');
      }
    })
  })

  $('.ttp').tooltip();
  $('select').selectpicker();

})
</script>

</body>
</html>