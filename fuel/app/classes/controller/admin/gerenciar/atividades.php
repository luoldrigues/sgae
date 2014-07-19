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

class Controller_Admin_Gerenciar_Atividades extends Controller_Admin
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
			$data['atividadeCursos'][$v['idAtividade']] = $v['idAtividade'];
		}

		if(Input::is_ajax())
		{
			if($idCurso != 0)
			{
				$data['atividades'] = Model_Atividade::find()->related('cursos')->where('cursos.idCurso', $idCurso)->order_by('nome')->get();
				return View::forge('admin/gerenciar/content/atividades', $data)->render();
			}
			else
			{
				$data['atividades'] = Model_Atividade::find()->order_by('nome')->get();
				return View::forge('admin/gerenciar/content/atividades', $data)->render();
			}
		}

		return View::forge('admin/gerenciar/atividades', $data)->render();
	}
}