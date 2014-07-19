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

class Controller_Admin_Gerenciar_Alunos extends Controller_Admin
{
	public function action_index($idCurso = 0)
	{
		$data['title']  = 'Gerenciar Atividades';
		$data['cursos'] = Model_Curso::find('all');
		$data['menu'] 	= View::forge('admin/menu');

		if(Session::get('message'))
		{
			$data['message'] = Session::get('message');
			Session::delete('message');

			if(Session::get('msgtype'))
			{
				$data['msgtype'] = Session::get('msgtype');
				Session::delete('msgtype');
			}
		}

		$al = Model_AtividadeAluno::find('all');
		foreach ($al as $v)
		{
			$data['atividadeAluno'][$v->idAluno][] = $v->idAluno;
		}

		if(Input::is_ajax())
		{
			if($idCurso != 0)
			{
				$data['alunos'] = Model_Aluno::find()->related('cursos')->related('atividades')->where('cursos.idCurso', $idCurso)->order_by('nome')->get();
				return View::forge('admin/gerenciar/content/alunos', $data)->render();
			}
			else
			{
				$data['alunos'] = Model_Aluno::find()->related('atividades')->order_by('nome')->get();
				return View::forge('admin/gerenciar/content/alunos', $data)->render();
			}
		}

		return View::forge('admin/gerenciar/alunos', $data)->render();
	}
}