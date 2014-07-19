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
if(isset($alunos)){
    foreach ($alunos as $aluno) { ?>
        <table class="table">
            <thead>
                <tr>
                    <td width="50%"><strong>Aluno:</strong> <?php echo $aluno['nome']; ?></td>
                    <td><strong>RA:</strong> <?php echo $aluno['ra']; ?></td>
                </tr>
            </thead>
        </table>

        <?php if(count($aluno['atividades']) > 0){ ?>
        <table class="table">
          <thead>
            <tr>
              <th>Atividade</th>
              <th>Descrição</th>
              <th>Carga Horária</th>
              <th>Operações</th>
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
                      <td>'.$atividade["carga_horaria"].'</td>
                      <td><a href="'.Uri::base().'admin/atividades-alunos/editar/'.$atividade["idAtividadeAluno"].'">Editar</a><br><a href="'.Uri::base().'admin/atividades-alunos/delete/'.$atividade["idAtividadeAluno"].'">Excluir</a></td>
                    </tr>';
                  }
                }
              ?>
          </tbody>
        </table>
        <?php }else{ echo '<div style="text-align:center;font-weight:bold">Nenhuma Atividade Relacionada</div><br /><br />'; } ?>

 
  <form class="form-horizontal" action="<?php echo Uri::base(); ?>admin/atividades-alunos/inserir" method="POST">
    <input type="hidden" name="idAluno" value="<?php echo $aluno['idAluno']; ?>">
    <div style="text-align:center">
        <button type="submit" class="btn">Inserir Nova Atividade</button>
    </div>
  </form>

<?php
    }
}
?>

</div>

<?php echo Asset::js('jquery-1.7.1.min.js'); ?>
<?php echo Asset::js('bootstrap.js'); ?>

</body>
</html>