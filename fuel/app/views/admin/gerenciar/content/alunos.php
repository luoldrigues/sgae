<?php if(count($alunos) < 1){ echo 'Nenhuma aluno cadastrado.';exit; } ?>
<table class="table">
  <thead>
    <tr>
      <th>RA</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Operações</th>
    </tr>
  </thead>
  <tbody>
      <?php
        if(is_array($alunos)){
          foreach ($alunos as $aluno) {
            echo '
            <tr>
              <td>'.$aluno["ra"].'</td>
              <td>'.$aluno["nome"].'</td>
              <td>'.$aluno["email"].'</td>
              <td><a href="'.Uri::base().'admin/editar/alunos/'.$aluno["idAluno"].'">Editar</a><br>';
              if(isset($atividadeAluno[$aluno['idAluno']])){
                if(!in_array($aluno['idAluno'], $atividadeAluno[$aluno['idAluno']])){ echo '<a href="'.Uri::base().'admin/deletar/alunos/'.$aluno["idAluno"].'">Excluir</a>'; }
              }
              else{
                echo '<a href="'.Uri::base().'admin/deletar/alunos/'.$aluno["idAluno"].'">Excluir</a>';
              }
              echo '</td>
            </tr>';
          }
        }
      ?>
  </tbody>
</table>