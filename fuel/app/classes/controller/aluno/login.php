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

class Controller_Aluno_Login extends Controller
{
	public function action_index()
	{
		$data['title'] = 'Login :: Alunos';

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

		Session::destroy();
		return View::forge('alunos/login', $data)->render();
	}

	public function post_index()
	{
		$senha = Input::post('password');

		if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/', $senha))
		{
			Session::set('message','Usuário ou Senha Inválido(s)');
			return Response::redirect(Uri::base().'login');
		}

		$senha = Crypt::encode($senha, Config::get('app.keycrypt'));

		if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', Input::post('username')))
		{
			$aluno = Model_Aluno::find()->where(array('email' => Input::post('username'), 'senha' => $senha))->get();
			if(!$aluno)
			{
				Session::set('message','Usuário ou Senha Inválido(s)');
				return Response::redirect(Uri::base().'login');
			}
			else
			{
				$senha = Crypt::decode($senha,    Config::get('app.keycrypt'));
				$senha = Crypt::encode($senha,    Config::get('app.keycrypt2'));
				$crypt = Crypt::encode(serialize(array(0 => $senha, 1 => Input::post('username'))), Config::get('app.keycrypt2'));
				$crypt = base64_encode($crypt);
				Session::set('usersid',$crypt);
				Session::set('msgtype','success');
				Session::set('message', 'Logado com sucesso!');
				foreach($aluno AS $al)
				{
					$ra = $al['ra'];
					break;
				}
				return Response::redirect(Uri::base() . 'relatorio/' . $ra);
			}
		}
		elseif(preg_match('/^(?=.*[0-9]).*$/', Input::post('username')))
		{
			$aluno = Model_Aluno::find()->where(array('ra' => Input::post('username'), 'senha' => $senha))->get();
			if(!$aluno)
			{
				Session::set('message','Usuário ou Senha Inválido(s)');
				return Response::redirect(Uri::base().'login');
			}
			else
			{
				$senha = Crypt::decode($senha,    Config::get('app.keycrypt'));
				$senha = Crypt::encode($senha,    Config::get('app.keycrypt2'));
				$crypt = Crypt::encode(serialize(array(0 => $senha, 2 => Input::post('username'))), Config::get('app.keycrypt2'));
				$crypt = base64_encode($crypt);
				Session::set('usersid',$crypt);
				Session::set('msgtype','success');
				Session::set('message', 'Logado com sucesso!');
				foreach($aluno AS $al)
				{
					$ra = $al['ra'];
					break;
				}
				return Response::redirect(Uri::base() . 'relatorio/' . $ra);
			}
		}
		else
		{
			Session::set('message','Usuário ou Senha Inválido(s)');
			return Response::redirect(Uri::base().'login');
		}
	}
}