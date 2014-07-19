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

class Controller_Aluno_Cadastrar extends Controller
{
	public function action_index($idCurso = null)
	{
		$data['title'] = 'Cadastro :: Alunos';
		$data['cursos'] = Model_Curso::find()->order_by('nome')->get();

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

		return View::forge('alunos/cadastrar', $data)->render();
	}

	public function post_index()
	{
		$idCurso  = Input::post('idCurso');
		$curso    = Model_Curso::find($idCurso);
		if(!$curso)
		{
			Session::set('message','Curso Inválido');
			return Response::redirect(Uri::base().'cadastrar');
		}
		unset($curso);

		if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', Input::post('email')))
		{
			Session::set('message','Email Inválido. Verifique o email digitado!');
			return Response::redirect(Uri::base().'cadastrar');
		}

		$senha = \Input::post('senha');
		$confirmasenha = \Input::post('confirmasenha');

		if($senha != $confirmasenha)
		{
			Session::set('message','Senha Inválida. Tente outra senha!');
			return Response::redirect(Uri::base().'cadastrar');
		}
		elseif(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/', $senha))
		{
			Session::set('message','Senha Inválida. Tente outra senha!');
			return Response::redirect(Uri::base().'cadastrar');
		}

		if(!is_numeric(Input::post('ra')))
		{
			Session::set('message','RA Inválido. Verifique o número digitado!');
			return Response::redirect(Uri::base().'cadastrar');
		}

		$senha = Crypt::encode($confirmasenha, Config::get('app.keycrypt'));

		$aluno = Model_Aluno::forge();

		$val = Model_Aluno::validate();

		if ($val->run())
		{
			$alunoval = Model_Aluno::find()->where('email',$val->validated('email'))->get();
			if($alunoval)
			{
				Session::set('message','Email inválido ou já cadastrado. Verifique o email digitado e/ou entre em contato com o administrador!');
				return Response::redirect(Uri::base().'cadastrar');
			}
			unset($alunoval);

			$alunoval = Model_Aluno::find()->where('ra',$val->validated('ra'))->get();
			if($alunoval)
			{
				Session::set('message','RA inválido ou já cadastrado. Verifique o RA digitado e/ou entre em contato com o administrador!');
				return Response::redirect(Uri::base().'cadastrar');
			}
			unset($alunoval);

			$aluno->nome       = $val->validated('nome');
			$aluno->idCurso    = $idCurso;
			$aluno->email      = $val->validated('email');
			$aluno->ra         = $val->validated('ra');
			$aluno->senha      = $senha;

			if($aluno->save())
			{
				Session::set('msgtype','success');
				Session::set('message', 'Cadastrado com sucesso!');
				return Response::redirect(Uri::base().'login');
			}
			else
			{
				Session::set('message', 'Ocorreu um erro.');
				return Response::redirect(Uri::base().'cadastrar');
			}
		}
		else
		{
			$errors = $val->show_errors();
			Session::set('message', $errors);
			return Response::redirect(Uri::base().'cadastrar');
		}
	}
}