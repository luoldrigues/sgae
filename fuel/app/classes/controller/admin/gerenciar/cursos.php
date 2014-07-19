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

class Controller_Admin_Gerenciar_Cursos extends Controller_Admin
{
	public function action_index()
	{
		$data['title']  = 'Gerenciar Cursos';
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

		$ca = Model_CursoAtividade::find('all');

		foreach ($ca as $v)
		{
			$data['cursoAtividades'][$v['idCurso']] = $v['idCurso'];
		}

		return View::forge('admin/gerenciar/cursos', $data)->render();
	}

}