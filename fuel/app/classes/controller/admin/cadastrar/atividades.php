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

class Controller_Admin_Cadastrar_Atividades extends Controller_Admin
{
	public function action_index()
	{
		$data['title'] 	= 'Cadastrar Atividades';
		$data['cursos'] = Model_Curso::find()->order_by('nome')->get();
		$data['menu'] 	= View::forge('admin/menu');
		return View::forge('admin/form/atividades', $data)->render();
	}

	public function post_index()
	{
		$atividade = Model_Atividade::forge();

		$datadb = $this->datadb(\Input::post('data_atividade'));

		$val = Model_Atividade::validate();

		if ($val->run())
		{
			$atividade->nome 			= $val->validated('nome');
			$atividade->carga_horaria 	= $val->validated('carga_horaria');
			$atividade->data_atividade 	= $datadb;
			$atividade->descricao 		= $val->validated('descricao');

			if(Input::post('idCurso'))
			{
				foreach (Input::post('idCurso') as $idCurso)
				{
					$atividade->cursos[] = Model_Curso::find($idCurso);
				}
			}

			if($atividade->save())
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

	private function datadb($data)
	{
		$datadb = NULL;

		if (preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])[\/](0[1-9]|1[0-2])[\/](19|20)[0-9]{2}$/', $data))
		{
			$datadb = implode("-",array_reverse(explode("/",$data)));
		}
		else if(preg_match('/^(19|20)[0-9]{2}[-](0[1-9]|1[0-2])[-](0[1-9]|[1-2][0-9]|3[0-1])$/', $data))
		{
			$datadb = $data;
		}
		else if(preg_match('/^(19|20)[0-9]{2}[\/](0[1-9]|1[0-2])[\/](0[1-9]|[1-2][0-9]|3[0-1])$/', $data))
		{
			$datadb = str_replace("/", "-", $data);
		}
		else if(preg_match('/^(0[1-9]|[1-2][0-9]|3[0-1])[-](0[1-9]|1[0-2])[-](19|20)[0-9]{2}$/', $data))
		{
			$datadb = implode("-",array_reverse(explode("-",$data)));
		}

		return $datadb;
	}
}