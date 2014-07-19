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

class Controller_Admin_Relatorio extends Controller_Base
{
	public function action_index()
	{
		$data['title'] = 'Relatório :: Busca';
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

		return View::forge('admin/relatorio/busca', $data)->render();
	}

	public function post_index()
	{
		$error = $aluno = false;

		if(Input::post('ra'))
		{
			$ra = Input::post('ra');
			$aluno = Model_Aluno::find()->related('atividades')->where('ra',$ra)->get();
		}
		elseif(Input::post('idAluno'))
		{
			$idAluno = Input::post('idAluno');
			$aluno = Model_Aluno::find()->related('atividades')->where('idAluno',$idAluno)->get();
		}

		if($aluno)
		{
			foreach ($aluno as $key => $aluno1)
			{
				$this->data['ra'] = $aluno1['ra'];
			}
		}
		else
		{
			$error = true;
		}

		if(!$error)
		{
			return Response::redirect(Uri::base().'admin/relatorio/'.$this->data['ra']);
		}
		else
		{
			Session::set('message','Aluno não encontrado! Verifique os parametros da busca!');
			return Response::redirect(Uri::base().'admin/relatorio');
		}
	}

	public function action_ver($ra = 0)
	{
		$data['title'] = 'Relatório';

		$error = $aluno = false;

		$aluno = Model_Aluno::find()->related('atividades')->where('ra',$ra)->get();

		$atividades = Model_Atividade::find('all');
		foreach ($atividades as $key => $atividade)
		{
			$arrAtividade[$atividade->idAtividade] = $atividade->nome;
		}

		if($aluno)
		{
			foreach ($aluno as $aluninho)
			{
				$data['aluno']   = $aluninho;
				$idCurso         = $aluninho->idCurso;
				$curso           = Model_Curso::find($idCurso);
				$data['curso']   = $curso;
				$ch_curso        = $curso->carga_horaria;
				$ch_cumprida     = 0;
				foreach ($aluninho['atividades'] as $atividade)
				{
					$ch_cumprida += $atividade['carga_horaria'];
				}
				$percent_bar     = (($ch_cumprida * 100)/$ch_curso);
				if($percent_bar >= 100)
				{
					$percent_bar = 100;
				}
				$data['percent_bar']    = round($percent_bar);
				$data['ch_cumprida']    = $ch_cumprida;
				$data['atividade_nome'] = $arrAtividade;

				break;
			}
		}
		else
		{
			$error = true;
		}

		$data['admin'] = true;

		if(!$error)
		{
			return View::forge('admin/relatorio/resultado', $data)->render();
		}
		else
		{
			echo utf8_decode('Relatório não encontrado!');
		}
	}
}