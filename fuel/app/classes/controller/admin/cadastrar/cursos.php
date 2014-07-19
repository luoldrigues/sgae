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

class Controller_Admin_Cadastrar_Cursos extends Controller_Admin
{
	public function action_index()
	{
		$data['title'] = 'Cadastrar Cursos';
		$data['menu']  = View::forge('admin/menu');
		return View::forge('admin/form/cursos', $data)->render();
	}

	public function post_index()
	{
		$curso = Model_Curso::forge();

		$val = Model_Curso::validate();

		if ($val->run())
		{
			$curso->nome 			= $val->validated('nome');
			$curso->carga_horaria 	= $val->validated('carga_horaria');

			if($curso->save())
			{
				Session::set('msgtype','success');
				Session::set('message', 'Registro salvo com sucesso!');
				return Response::redirect(Uri::base().'admin');
			}
			else
			{
				Session::set('message', 'Ocorreu um erro.');
				return Response::redirect(Uri::base().'admin');
			}
		}
		else
		{
			$errors = $val->show_errors();
			Session::set('message', $errors);
			return Response::redirect(Uri::base().'admin');
		}
	}
}