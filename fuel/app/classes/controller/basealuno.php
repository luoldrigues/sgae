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

class Controller_BaseAluno extends Controller
{
	public function before()
	{
		parent::before();
		$crypt = Session::get('usersid');
		$crypt = base64_decode($crypt);
		$crypt = Crypt::decode($crypt,    Config::get('app.keycrypt2'));
		$crypt = unserialize($crypt);
		$senha = Crypt::decode($crypt[0], Config::get('app.keycrypt2'));
		$senha = Crypt::encode($senha,    Config::get('app.keycrypt'));
		if(isset($crypt[1]))
		{
			$aluno = Model_Aluno::find()->where(array('email' => $crypt[1], 'senha' => $senha))->get();
			if(!$aluno)
			{
				Session::destroy();
				Session::set('message','Acesso Restrito!');
				return Response::redirect(Uri::base().'login');
			}
		}
		elseif(isset($crypt[2]))
		{
			$aluno = Model_Aluno::find()->where(array('ra' => $crypt[2], 'senha' => $senha))->get();
			if(!$aluno)
			{
				Session::destroy();
				Session::set('message','Acesso Restrito!');
				return Response::redirect(Uri::base().'login');
			}
		}
		else
		{
			Session::destroy();
			Session::set('message','Acesso Restrito!');
			return Response::redirect(Uri::base().'login');
		}
	}
}