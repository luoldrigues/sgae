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

  <form class="form-horizontal" action="<?php if($inserir){ echo Uri::current().'/'.$idAluno; }else{ echo Uri::current(); } ?>" method="POST">
    <div class="control-group">
      <label class="control-label" for="Nome">Atividade*</label>
      <div class="controls">
        <select class="span4" name="idAtividade" id="idAtividade" required min="1">
          <?php
            if(isset($atividades) AND is_array($atividades)){
              if(!isset($atividadeAluno)){ echo '<option selected disabled>Nenhum selecionado</option>'; }
              foreach ($atividades AS $k => $atividade) {
                  $select = null;
                  if(isset($atividadeAluno)){ if($atividadeAluno['idAtividade'] == $atividade['idAtividade']){   $select = 'selected';   } }
                  echo '<option value="'.$atividade['idAtividade'].'" '.$select.'>'.$atividade['nome'].'</option>';
              }
            }
          ?>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Data">Data*</label>
      <div class="controls">
        <div class="input-prepend" id="mydate">
          <span class="add-on"><i class="icon-calendar"></i></span>
          <input class="span2 data" type="text" data-format="dd/MM/yyyy" name="data" min="1" id="data" pattern="(0[1-9]|[1-2][0-9]|3[0-1])[\/](0[1-9]|1[0-2])[\/](19|20)[0-9]{2}" required value="<?php if(isset($atividadeAluno['data'])){ echo $atividadeAluno['data']; }else{ echo date('d/m/Y'); } ?>">
        </div>
        <span class="ttp" style="cursor:pointer" title="Dica: Utilize o calendário (clique no ícone)"> (?) </span>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="CargaHoraria">Carga Horária*</label>
      <div class="controls">
        <input style="width:60px" type="number" name="carga_horaria" min="1" id="CargaHoraria" required <?php if(isset($atividadeAluno['carga_horaria'])){ echo 'value="'.$atividadeAluno['carga_horaria'].'"'; }?>> horas. 
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Descricao">Descrição</label>
      <div class="controls">
        <textarea class="span4" name="descricao" rows="3" id="descricao"><?php if(isset($atividadeAluno['descricao'])){ echo $atividadeAluno['descricao']; }?></textarea>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn"><?php if(!$inserir){ echo 'Atualizar'; }else{ echo 'Cadastrar'; } ?></button>
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
<?php if($inserir){ ?>

$('#idAtividade').on('change', function(){
  var val = $(this).val();
  $.post('<?php echo Uri::base();?>admin/consulta/atividade', {idAtividade:val}, function(data){
    $('#CargaHoraria').val(data.carga_horaria);
    $('#descricao').html(data.descricao);
    if(data.data_atividade != null){
     $('#data').val(data.data_atividade);
    }
  })
})

<?php } ?>
  $('.ttp').tooltip();
  $('select').selectpicker();
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
  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
})
</script>
</body>
</html>