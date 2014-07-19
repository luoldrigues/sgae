<?php if(count($atividades) < 1){ echo 'Nenhuma atividade cadastrada.';exit; } ?>
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
        if(is_array($atividades)){
          foreach ($atividades as $atividade) {
            echo '
            <tr>
              <td>'.$atividade["nome"].'</td>
              <td>'.$atividade["descricao"].'</td>
              <td>'.$atividade["carga_horaria"].'</td>
              <td><a href="'.Uri::base().'admin/editar/atividades/'.$atividade["idAtividade"].'">Editar</a><br>';
              if(isset($atividadeCursos)){
                if(!in_array($atividade['idAtividade'], $atividadeCursos)){ echo '<a href="'.Uri::base().'admin/deletar/atividades/'.$atividade["idAtividade"].'">Excluir</a>'; }
              }
              else{
                echo '<a href="'.Uri::base().'admin/deletar/atividades/'.$atividade["idAtividade"].'">Excluir</a>';
              }
              echo '</td>
            </tr>';
          }
        }
      ?>
  </tbody>
</table>