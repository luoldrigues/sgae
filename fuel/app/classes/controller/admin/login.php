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

class Controller_Admin_Login extends Controller
{
	public function action_index()
	{
		$data = array();
		$data['title'] = 'Login';
		return View::forge('admin/login', $data)->render();
	}

	public function post_index()
	{
		if(!Input::post('username') OR !Input::post('password'))
		{
			return View::forge('admin/restrito')->render();
		}

		$username = Input::post('username');
		$password = Input::post('password');
		$password = Crypt::encode($password, Config::get('app.keycrypt2'));

		if($username == 'sgaeadmin' AND $password == 'xNwrdnGkdj2mYb46dJeoNXNBZnRKUndhS0pCVkJrOURRSmxNTXZocHA5c1ZGaUxpQVViZk1oaWZVN1E')
		{
			Session::set('userid', '46Xf0y7x7mYpnsGvtWa4mkNtZkJmdzc0aW0xSEtkcnQxUzgwSFhjbHVCdGdXUndYWndYOFc4MHZNUzQ');
			return Response::redirect('admin');
		}
		else
		{
			$data = array();
			$data['title'] = 'Login';
			$data['message'] = 'Usuário ou Senha Inválidos(s)';
			return View::forge('admin/login', $data)->render();
		}
	}
}