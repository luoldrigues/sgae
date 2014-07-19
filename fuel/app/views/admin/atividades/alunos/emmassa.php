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

  <form class="form-horizontal" action="<?php echo Uri::base(); ?>admin/atividades-alunos/massa" method="POST">
    <input type="hidden" name="idAtividade" value="<?php echo $atividade['idAtividade']; ?>">
    <div class="control-group">
      <label class="control-label" for="CargaHoraria">Atividade</label>
      <div class="controls" style="padding-top: 5px;">
        <?php echo $atividade['nome']; ?>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Data">Data*</label>
      <div class="controls">
        <div class="input-prepend" id="mydate">
          <span class="add-on"><i class="icon-calendar"></i></span>
          <input class="span2 data" type="text" data-format="dd/MM/yyyy" name="data" min="1" id="data" required value="<?php echo $atividade['data_atividade']; ?>">
        </div>
        <span class="ttp" style="cursor:pointer" title="Dica: Utilize o calendário (clique no ícone)"> (?) </span>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="CargaHoraria">Carga Horária*</label>
      <div class="controls">
        <input class="span1" type="number" name="carga_horaria" min="1" id="CargaHoraria" required value="<?php echo $atividade['carga_horaria']; ?>"> horas. 
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="Descricao">Descrição</label>
      <div class="controls">
        <textarea class="span4" name="descricao" rows="3" id="descricao"><?php echo $atividade['descricao']; ?></textarea>
      </div>
    </div>
    <div class="my-content-box">
      <div class="title">Selecione os alunos que participaram da atividade:</div>
      <table class="table">
        <thead>
          <tr>
            <th width='10'><input type="checkbox" id="todos" onclick="marcardesmarcar();"></th>
            <th width='80'>RA</th>
            <th>Nome do Aluno</th>
          </tr>
        </thead>
        <tbody>
            <?php
              foreach($alunos AS $aluno){
              echo '
              <tr>
                <td><input type="checkbox" name="idAlunos[]" value="'.$aluno['idAluno'].'" class="marcar"></td>
                <td>'.$aluno["ra"].'</td>
                <td>'.$aluno["nome"].'</td>
              </tr>';
              } 
            ?>
        </tbody>
      </table>
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
<?php echo Asset::js('bootstrap-datetimepicker.min.js'); ?>
<?php echo Asset::js('bootstrap-datetimepicker.pt-BR.js'); ?>

<script>
$(document).ready(function(){

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
})

function marcardesmarcar(){
   if ($("#todos").attr("checked")){
      $('.marcar').each(
         function(){
            $(this).attr("checked", true);
         }
      );
   }else{
      $('.marcar').each(
         function(){
            $(this).attr("checked", false);
         }
      );
   }
}
</script>
</body>
</html>