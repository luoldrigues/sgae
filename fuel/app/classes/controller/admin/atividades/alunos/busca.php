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

class Controller_Admin_Atividades_Alunos_Busca extends Controller_Admin
{
	public function action_index()
	{
		$data['title']      = 'Atividades Alunos :: Busca';
		$data['cursos']     = Model_Curso::find('all');
		$data['atividades'] = Model_Atividade::find('all');
		$data['menu']       = View::forge('admin/menu');

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

		return View::forge('admin/atividades/alunos/busca', $data)->render();
	}

	public function post_index()
	{
		$data['title'] = 'Atividades Alunos :: Busca';
		$data['menu'] 	= View::forge('admin/menu');

		$error = $aluno = false;

		if(Input::post('ra'))
		{
			$ra    = Input::post('ra');
			$aluno = Model_Aluno::find()->related('atividades')->where('ra',$ra)->get();
		}
		elseif(Input::post('idAluno'))
		{
			$idAluno = Input::post('idAluno');
			$aluno   = Model_Aluno::find()->related('atividades')->where('idAluno',$idAluno)->get();
		}
		elseif(Input::post('idAtividade'))
		{
			$idAtividade = Input::post('idAtividade');
			$idCurso     = Input::post('idCurso');
			$atividade   = Model_Atividade::find($idAtividade);
			$alunos      = Model_Aluno::find()->related('cursos')->where('cursos.idCurso', $idCurso)->order_by('ra')->get();
			if($atividade->data_atividade)
			{
				$atividade->data_atividade = implode("/",array_reverse(explode("-",$atividade->data_atividade)));
			}
			else
			{
				$atividade->data_atividade = date('d/m/Y');
			}
			if($alunos)
			{
				$data['alunos']    = $alunos;
				$data['atividade'] = $atividade;
				return View::forge('admin/atividades/alunos/emmassa', $data)->render();
			}
			else
			{
				$erro = true;
			}
		}

		$atividades = Model_Atividade::find('all');
		foreach ($atividades as $key => $atividade)
		{
			$arrAtividade[$atividade->idAtividade] = $atividade->nome;
		}

		if($aluno)
		{
			$data['alunos']         = $aluno;
			$data['atividade_nome'] = $arrAtividade;
		}
		else
		{
			$error = true;
		}

		if(!$error)
		{
			return View::forge('admin/atividades/alunos/resultado', $data)->render();
		}
		else
		{
			Session::set('message','Aluno(s) não encontrado(s)! Verifique os parametros da busca!');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}
	}
}