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

class Controller_Admin_Deletar extends Controller_Admin
{
	public function get_atividades($idAtividade)
	{
		$atividade = Model_Atividade::find($idAtividade);
		if($atividade)
		{
			if($atividade->delete())
			{
				Session::set('msgtype','success');
				Session::set('message', 'Registro removido com sucesso!');
				return Response::redirect(Uri::base().'admin/gerenciar/atividades');
			}
			else
			{
				Session::set('message', 'Ocorreu um erro. Este registro não pode ser removido.');
				return Response::redirect(Uri::base().'admin/gerenciar/atividades');
			}
		}
		else
		{
			Session::set('message', 'Ocorreu um erro. Este registro não pode ser removido.');
			return Response::redirect(Uri::base().'admin/gerenciar/atividades');
		}
	}

	public function get_cursos($idCurso)
	{
		$curso = Model_Curso::find($idCurso);
		if($curso)
		{
			if($curso->delete())
			{
				Session::set('msgtype','success');
				Session::set('message', 'Registro removido com sucesso!');
				return Response::redirect(Uri::base().'admin/gerenciar/cursos');
			}
			else
			{
				Session::set('message', 'Ocorreu um erro. Este registro não pode ser removido.');
				return Response::redirect(Uri::base().'admin/gerenciar/cursos');
			}
		}
		else
		{
			Session::set('message', 'Ocorreu um erro. Este registro não pode ser removido.');
			return Response::redirect(Uri::base().'admin/gerenciar/cursos');
		}
	}

	public function get_alunos($idAluno)
	{
		$aluno = DB::query("DELETE FROM aluno WHERE idAluno = '".$idAluno."' LIMIT 1")->execute();
		if($aluno)
		{
			Session::set('msgtype','success');
			Session::set('message', 'Registro removido com sucesso!');
			return Response::redirect(Uri::base().'admin/gerenciar/alunos');
		}
		else
		{
			Session::set('message', 'Ocorreu um erro. Este registro não pode ser removido.');
			return Response::redirect(Uri::base().'admin/gerenciar/alunos');
		}
	}
}