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

class Controller_Aluno_Relatorio extends Controller_BaseAluno
{
	public function action_ver($ra)
	{
		$error = $aluno = false;

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

		$data['title'] = 'Relatório';

		$atividades = Model_Atividade::find('all');
		foreach ($atividades as $key => $atividade)
		{
			$arrAtividade[$atividade->idAtividade] = $atividade->nome;
		}

		if($aluno)
		{
			foreach ($aluno as $aluninho)
			{
				$raAutorizado = $aluninho->ra;

				if($ra != $raAutorizado)
				{
					$error = true;
				}
				else
				{
					$data['aluno']   = $aluninho;
					$idCurso         = $aluninho->idCurso;
					$curso           = Model_Curso::find($idCurso);
					$data['curso']   = $curso;
					$ch_curso        = $curso['carga_horaria'];
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
				}
				break;
			}
		}
		else
		{
			$error = true;
		}

		if(!$error)
		{
			return View::forge('admin/relatorio/resultado', $data)->render();
		}
		else
		{
			Session::destroy();
			Session::set('message','Você não tem permissão para visualizar este relatório.');
			return Response::redirect(Uri::base().'login');
		}
	}
}