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

<div class="container">
<?php
if(isset($aluno)){ ?>
<table width="100%"><tr><td>
<span style="font-size: 24.5px;font-weight:bold;">Relatório de Atividades</span><br /><br />
<p>Aluno: <?php echo  $aluno['nome']; ?></p>
<p>RA:    <?php echo  $aluno['ra']; ?></p>
</td><td style="width:500px;">
<div style="position:relative;right:0px;margin:20px;">
        <p>Curso: <?php echo $curso['nome']; ?></p>
        <p>Carga Horária Mínima: <?php echo $curso['carga_horaria']; ?> horas</p>
        <p>Carga Horária Cumprida: <?php echo $ch_cumprida; ?> horas</p>
        <div style="width:300px"><div class="progress" style="width:80%"><div class="bar" style="width: <?php echo $percent_bar; ?>%;"><?php echo $percent_bar; ?>%</div></div></div>
      </div>
</td></tr></table>
        <?php if(count($aluno['atividades']) > 0){ ?>
        <table class="table">
          <thead>
            <tr>
              <th>Atividade</th>
              <th>Descrição</th>
              <th>Data</th>
              <th>Carga Horária</th>
            </tr>
          </thead>
          <tbody>
              <?php
                if(is_array($aluno['atividades'])){
                  foreach ($aluno['atividades'] as $atividade) {
                    echo '
                    <tr>
                      <td>'.$atividade_nome[$atividade->idAtividade].'</td>
                      <td>'.$atividade["descricao"].'</td>
                      <td>'.maskData($atividade["data"]).'</td>                      
                      <td>'.$atividade["carga_horaria"].'</td>
                    </tr>';
                  }
                }
              ?>
          </tbody>
        </table>
        <?php }else{ echo '<div style="text-align:left;font-weight:bold">Nenhuma Atividade Registrada</div><br /><br />'; } 
}
?>
        <p>Data da Consulta: <?php echo date('d/m/Y H').'h'.date('i'); ?></p>
        <?php if(!isset($admin)){ ?><p><a href="<?php echo Uri::base(false); ?>logout">Logout</a></p><?php } ?>
</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>

</body>
</html>
<?php
function maskData($db){
  $d = explode('-', $db);
  return $d[1].'/'.$d[0];
}
?>