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
                echo '<div class="alert alert-'.$msgtype.' fade in" id="'.$msgtype.'"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.$msg.'</strong></div>';
            }
        }else{
            echo '<div class="alert alert-'.$msgtype.' fade in" id="'.$msgtype.'"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.html_entity_decode($message).'</strong></div>';
        }
    }
?>

<div class="control-group">
  <label class="control-label" for="Nome">Curso</label>
  <div class="controls">
    <select class="span4" name="idCurso" id="idCurso">
      <option value="0" selected>Todos</option>
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

<div id="result">
  <h3> Selecione o curso </h3>
</div>

</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>
<?php echo Asset::js('bootstrap-select.min.js'); ?>

<script>
$(document).ready(function(){

  $('#idCurso').on('change',function(){
      $.get('<?php echo Uri::base(); ?>admin/gerenciar/atividades/index/' + $(this).val(), function(data) {
        $('#result').html(data);
      });
  });

  $.get('<?php echo Uri::base(); ?>admin/gerenciar/atividades/', function(data) {
    $('#result').html(data);
  });

  $('select').selectpicker();

})
</script>

</body>
</html>