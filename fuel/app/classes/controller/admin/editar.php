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

class Controller_Admin_Editar extends Controller_Admin
{
	public function action_atividades($idAtividade)
	{
		$data['title']  = 'Editar Atividades';
		$data['menu'] 	= View::forge('admin/menu');

		$atividades 		= Model_Atividade::find()->where('idAtividade', $idAtividade)->related('cursos')->get();
		$data['atividade'] 	= $atividades[$idAtividade];

		if($atividades[$idAtividade]['data_atividade'])
		{
			$data['atividade']['data_atividade'] = implode("/",array_reverse(explode("-",$atividades[$idAtividade]['data_atividade'])));
		}

		foreach ($atividades[$idAtividade]['cursos'] AS $key => $curso)
		{
			$data['atividade_curso'][] = $curso['idCurso'];
		}

		$data['cursos'] = Model_Curso::find('all');

		return View::forge('admin/form/atividades', $data)->render();
	}

	public function post_atividades($idAtividade)
	{
		$atividade = Model_Atividade::find($idAtividade);

		$datadb = $this->datadb(\Input::post('data_atividade'));

		$val = Model_Atividade::validate('edit');

		if ($val->run())
		{
			$atividade->nome 			= $val->validated('nome');
			$atividade->carga_horaria 	= $val->validated('carga_horaria');
			$atividade->descricao 		= $val->validated('descricao');
			$atividade->data_atividade	= $datadb;

			$db = DB::delete('curso_has_atividade')->where('idAtividade', $idAtividade)->execute();

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
				return Response::redirect(Uri::base().'admin/gerenciar/atividades');
			}
			else
			{
				Session::set('message', 'Ocorreu um erro.');
				return Response::redirect(Uri::base().'admin/gerenciar/atividades');
			}
		}
		else
		{
			$errors = $val->show_errors();
			Session::set('message', $errors);
			return Response::redirect(Uri::base().'admin/gerenciar/atividades');
		}
	}

	public function action_cursos($idCurso)
	{
		$data['title'] = 'Editar Cursos';
		$data['menu']  = View::forge('admin/menu');
		$data['curso'] = Model_Curso::find($idCurso);

		return View::forge('admin/form/cursos', $data)->render();
	}

	public function post_cursos($idCurso)
	{
		$curso = Model_Curso::find($idCurso);

		$val = Model_Curso::validate('edit');

		if ($val->run())
		{
			$curso->nome 			= $val->validated('nome');
			$curso->carga_horaria 	= $val->validated('carga_horaria');

			if($curso->save())
			{
				Session::set('msgtype','success');
				Session::set('message', 'Registro salvo com sucesso!');
				return Response::redirect(Uri::base().'admin/gerenciar/cursos');
			}
			else
			{
				Session::set('message', 'Ocorreu um erro.');
				return Response::redirect(Uri::base().'admin/gerenciar/cursos');
			}
		}
		else
		{
			$errors = $val->show_errors();
			Session::set('message', $errors);
			return Response::redirect(Uri::base().'admin/gerenciar/cursos');
		}
	}

	public function action_alunos($idAluno)
	{
		$data['title'] = 'Editar Aluno';
		$data['menu'] 	= View::forge('admin/menu');

		$alunos 		= Model_Aluno::find()->where('idAluno', $idAluno)->related('cursos')->get();
		$data['aluno'] 	= $alunos[$idAluno];

		if($alunos[$idAluno]['data_aluno'])
		{
			$data['aluno']['data_aluno'] = implode("/",array_reverse(explode("-",$alunos[$idAluno]['data_aluno'])));
		}

		foreach ($alunos[$idAluno]['cursos'] AS $key => $curso)
		{
			$data['aluno_curso'][] = $curso['idCurso'];
		}

		$data['cursos']    	= Model_Curso::find('all');

		return View::forge('admin/form/alunos', $data)->render();
	}

	public function post_alunos($idAluno)
	{
		$aluno = Model_Aluno::find($idAluno);

		$val = Model_Aluno::validate('edit');

		if(!Input::post('idCurso'))
		{
			Session::set('message','Curso inválido');
			return Response::redirect(Uri::base().'admin/gerenciar/alunos');
		}
		$idCurso = Input::post('idCurso');
		$cursos = Model_Curso::find($idCurso);
		if(!$cursos)
		{
			Session::set('message','Curso inválido');
			return Response::redirect(Uri::base().'admin/gerenciar/alunos');
		}
		unset($cursos);

		if(Input::post('senha'))
		{
			$senha = Crypt::encode(Input::post('senha'), Config::get('app.keycrypt'));
		}
		else
		{
			$senha = false;
		}

		if ($val->run())
		{
			$aluno->idCurso     = $idCurso;
			$aluno->nome        = $val->validated('nome');
			$aluno->email       = $val->validated('email');
			$aluno->ra          = $val->validated('ra');

			if($senha)
			{
				$aluno->senha   = $senha;
			}

			if($aluno->save())
			{
				Session::set('msgtype','success');
				Session::set('message', 'Registro salvo com sucesso!');
				return Response::redirect(Uri::base().'admin/gerenciar/alunos');
			}
			else
			{
				Session::set('message', 'Ocorreu um erro.');
				return Response::redirect(Uri::base().'admin/gerenciar/alunos');
			}
		}
		else
		{
			$errors = $val->show_errors();
			Session::set('message', $errors);
			return Response::redirect(Uri::base().'admin/gerenciar/alunos');
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