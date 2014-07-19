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
    <?php echo Asset::css('bootstrap-datetimepicker.min.css'); ?>
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
        <input class="span4" type="text" name="nome" id="nome" required placeholder="Nome da Atividade" <?php if(isset($atividade['nome'])){ echo 'value="'.$atividade['nome'].'"'; }?>>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Nome">Curso*</label>
      <div class="controls">
        <select class="span4" name="idCurso[]" id="idCurso" multiple>
          <?php
            if(isset($cursos) AND is_array($cursos)){
              foreach ($cursos AS $k => $curso) {
                  $select = null;
                  if(isset($atividade_curso)){ if(in_array($curso['idCurso'], $atividade_curso)){   $select = 'selected="selected"';   } }
                  echo '<option value="'.$curso['idCurso'].'" '.$select.'>'.$curso['nome'].'</option>';
              }
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="CargaHoraria">Carga Horária*</label>
      <div class="controls">
        <input style="width:60px" type="number" required name="carga_horaria" min="1" id="CargaHoraria"  <?php if(isset($atividade['carga_horaria'])){ echo 'value="'.$atividade['carga_horaria'].'"'; }?>> horas. 
        <span class="ttp" style="cursor:pointer" title="Define o valor padrão de carga horaria para esta atividade"> (?) </span>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Data">Data</label>
      <div class="controls">
        <div class="input-prepend" id="mydate">
          <span class="add-on"><i class="icon-calendar"></i></span>
          <input class="span2 data" type="text" data-format="dd/MM/yyyy" name="data_atividade" pattern="(0[1-9]|[1-2][0-9]|3[0-1])[\/](0[1-9]|1[0-2])[\/](19|20)[0-9]{2}" id="data" value="<?php if(isset($atividade['data_atividade'])){ echo $atividade['data_atividade']; } ?>">
        </div>
        <span class="ttp" style="cursor:pointer" title="Define a data em que a atividade ocorreu (opcional)"> (?) </span>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Descricao">Descrição</label>
      <div class="controls">
        <textarea class="span4" name="descricao" rows="3"><?php if(isset($atividade['descricao'])){ echo $atividade['descricao']; }?></textarea>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn"><?php if(isset($atividade['nome'])){ echo 'Atualizar'; }else{ echo 'Cadastrar'; } ?></button>
      </div>
    </div>
  </form>

</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>
<?php echo Asset::js('bootstrap-select.min.js'); ?>
<?php echo Asset::js('bootstrap-datetimepicker.min.js'); ?>
<?php echo Asset::js('bootstrap-datetimepicker.pt-BR.js'); ?>
<?php echo Asset::js('bootstrap-validation.js'); ?>

<script>
$(document).ready(function(){

  $("input,textarea").not("[type=submit]").jqBootstrapValidation();
  $('.ttp').tooltip();
  $('#idCurso').selectpicker();
  $.fn.datetimepicker.defaults = {
    maskInput: true,           // disables the text input mask
    pickDate: true,            // disables the date picker
    pickTime: false,            // disables de time picker
    pick12HourFormat: false,   // enables the 12-hour format time picker
    pickSeconds: true,         // disables seconds in the time picker
    startDate: -Infinity,      // set a minimum date
    endDate: Infinity          // set a maximum date
  };
  $('#mydate').datetimepicker({
      language: 'pt-BR'
  });

  <?php
  if(!isset($atividade_curso)){ ?>
    $('#idCurso').find('option').each(function(){
      $(this).removeAttr('selected'); 
    });
    $('#idCurso').next().find('span:first').html('Nenhum selecionado');
    $('#idCurso').next().find('li').removeClass('selected');
  <?php } ?>

})
</script>
</body>
</html>