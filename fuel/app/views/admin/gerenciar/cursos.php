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

<table class="table">
  <thead>
    <tr>
      <th>Curso</th>
      <th>Operações</th>
    </tr>
  </thead>
  <tbody>
      <?php
        if(is_array($cursos)){
          foreach ($cursos as $curso) {
            echo '
            <tr>
              <td>'.$curso["nome"].'</td>
              <td><a href="'.Uri::base().'admin/editar/cursos/'.$curso["idCurso"].'">Editar</a>';
              if(isset($cursoAtividades)){
                if(!in_array($curso['idCurso'], $cursoAtividades)){ echo '<br><a href="'.Uri::base().'admin/deletar/cursos/'.$curso["idCurso"].'">Excluir</a>'; }
              }
              else{
                echo '<br><a href="'.Uri::base().'admin/deletar/cursos/'.$curso["idCurso"].'">Excluir</a>';
              }
              echo '</td>
            </tr>';
          }
        }
      ?>
  </tbody>
</table>

</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>

</body>
</html>