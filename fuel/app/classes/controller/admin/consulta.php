<?php
/**
 * SGAE - Sistema de Gestão de Atividades Extracurriculares
 *
 * @package    SGAE
 * @version    1.0
 * @author     Luan Oliveira Rodrigues
 * @license    MIT License
 * @copyright  2013
 */

class Controller_Admin_Consulta extends Controller_Rest
{
	public function post_alunos()
	{
		$idCurso = Input::post('idCurso');
		$data    = Model_Aluno::find()->related('cursos')->where('cursos.idCurso', $idCurso)->get();
		if($data)
		{
			foreach ($data as $k => $aluno)
			{
				echo '<option value="'.$aluno->idAluno.'">'.$aluno->nome.'</option>';
			}
		}
	}

	public function post_atividade()
	{
		$this->format   = 'json';

		$idAtividade 	= Input::post('idAtividade');
		$data			= Model_Atividade::find($idAtividade);

		if($data->data_atividade)
		{
			$data->data_atividade  = implode("/",array_reverse(explode("-",$data->data_atividade)));
		}

		return $this->response($data);
	}

	public function post_atividade_curso($idCurso)
	{
		$data = Model_Atividade::find()->select('idAtividade','nome')->related('cursos')->where('cursos.idCurso', $idCurso)->get();
		if($data)
		{
			foreach ($data as $k => $atividade)
			{
				echo '<option value="'.$atividade->idAtividade.'">'.$atividade->nome.'</option>';
			}
		}
	}
}