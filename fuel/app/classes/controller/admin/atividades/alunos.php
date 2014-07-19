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

class Controller_Admin_Atividades_Alunos extends Controller_Admin
{
	public function post_inserir($idAluno = null)
	{
		$error = false;

		if($idAluno)
		{
			$idAtividade = Input::post('idAtividade');
			if(!$idAtividade)
			{
				Session::set('message','Atividade Incorreta');
				return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
			}
			$atividade = Model_Atividade::find($idAtividade);
			if(!$atividade)
			{
				Session::set('message','Atividade Incorreta');
				return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
			}
			unset($atividade);

			$aluno = Model_Aluno::find($idAluno);
			if(!$aluno)
			{
				Session::set('message','Aluno não encontrado!');
				return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
			}
			unset($aluno);

			$atividade_aluno = Model_AtividadeAluno::forge();
			$val = Model_AtividadeAluno::validate();

			$datadb = $this->datadb(\Input::post('data'));

			if ($val->run())
			{
				$atividade_aluno->idAtividade 		= $idAtividade;
				$atividade_aluno->idAluno 			= $idAluno;
				$atividade_aluno->carga_horaria 	= $val->validated('carga_horaria');
				$atividade_aluno->descricao 		= $val->validated('descricao');
				$atividade_aluno->data 				= $datadb;

				if($atividade_aluno->save())
				{
					Session::set('msgtype','success');
					Session::set('message', 'Registro salvo com sucesso!');
					return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
				}
				else
				{
					Session::set('message', 'Ocorreu um erro.');
					return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
				}
			}
			else
			{
				$errors = $val->show_errors();
				Session::set('message', $errors);
				return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
			}
		}

		if(!Input::post('idAluno'))
		{
			Session::set('message','Aluno não encontrado!');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}

		$idAluno = Input::post('idAluno');
		$aluno = Model_Aluno::find($idAluno);

		if($aluno)
		{
			$data['title'] 		= 'Gerenciar Atividades';
			$data['atividades'] = Model_Atividade::find()->related('cursos')->where('cursos.idCurso',$aluno->idCurso)->order_by('nome')->get();
			$data['menu'] 		= View::forge('admin/menu');
			$data['idAluno']	= $aluno->idAluno;
			$data['inserir']	= true;
			return View::forge('admin/atividades/alunos/form', $data)->render();
		}

		Session::set('message','Aluno não encontrado!');
		return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
	}

	public function action_editar($idAtividadeAluno)
	{
		$data['title'] 		    = 'Editar Atividades do Aluno';
		$data['atividades']     = Model_Atividade::find('all');
		$data['atividadeAluno'] = $atividadesAluno = Model_AtividadeAluno::find($idAtividadeAluno);
		if($atividadesAluno)
		{
			$data['atividadeAluno']['data'] = implode("/",array_reverse(explode("-", $atividadesAluno['data'])));
			$data['menu'] 		= View::forge('admin/menu');
			$data['idAluno']	= $atividadesAluno->idAluno;
			$data['inserir']	= false;
			return View::forge('admin/atividades/alunos/form', $data)->render();
		}
		else
		{
			Session::set('message','Nenhuma atividade encontrada');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}
	}

	public function post_editar($idAtividadeAluno)
	{
		$atividade_aluno = Model_AtividadeAluno::find($idAtividadeAluno);

		$idAtividade = Input::post('idAtividade');
		$atividade   = Model_Atividade::find($idAtividade);
		if(!$atividade)
		{
			Session::set('message','Atividade Incorreta');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}
		unset($atividade);

		$datadb = $this->datadb(\Input::post('data'));

		$val = Model_AtividadeAluno::validate();

		if ($val->run())
		{
			$atividade_aluno->idAtividade 		= $idAtividade;
			$atividade_aluno->carga_horaria 	= $val->validated('carga_horaria');
			$atividade_aluno->descricao 		= $val->validated('descricao');
			$atividade_aluno->data 				= $datadb;

			if($atividade_aluno->save())
			{
				Session::set('msgtype','success');
				Session::set('message', 'Registro salvo com sucesso!');
				return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
			}
			else
			{
				Session::set('message', 'Ocorreu um erro.');
				return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
			}
		}
		else
		{
			$errors = $val->show_errors();
			Session::set('message', $errors);
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}
	}

	public function get_delete($idAtividadeAluno)
	{
		$atividade_aluno = Model_AtividadeAluno::find($idAtividadeAluno);

		if(!$atividade_aluno)
		{
			Session::set('message','Atividade Incorreta');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}

		if($atividade_aluno->delete())
		{
			Session::set('msgtype','success');
			Session::set('message', 'Registro excluido com sucesso!');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}
		else
		{
			Session::set('message', 'Ocorreu um erro.');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}
	}

	public function post_massa()
	{
		$idAlunos = Input::post('idAlunos');
		if(!$idAlunos)
		{
			Session::set('message', 'Nenhum aluno selecionado');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}

		$idAtividade = Input::post('idAtividade');
		$atividade   = Model_Atividade::find($idAtividade);
		if(!$atividade)
		{
			Session::set('message','Atividade Incorreta');
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}
		unset($atividade);

		$datadb = $this->datadb(\Input::post('data'));

		$registrado = $nao_registrado = array();

		$val = Model_AtividadeAluno::validate();

		if ($val->run())
		{
			foreach ($idAlunos as $key => $idAluno)
			{
				$atividade_aluno = Model_AtividadeAluno::forge();

				$aluno = Model_Aluno::find($idAluno);
				if(!$aluno)
				{
					$nao_registrado[] = $idAluno;
					unset($idAlunos[$key]);
					continue;
				}

				$ra[$idAluno] = $aluno->ra;
				unset($aluno);

				$atividade_aluno->idAtividade 		= $idAtividade;
				$atividade_aluno->idAluno 			= $idAluno;
				$atividade_aluno->carga_horaria 	= $val->validated('carga_horaria');
				$atividade_aluno->descricao 		= $val->validated('descricao');
				$atividade_aluno->data 				= $datadb;

				if($atividade_aluno->save())
				{
					$registrado[]     = $idAluno;
				}
				else
				{
					$nao_registrado[] = $idAluno;
				}
				unset($atividade_aluno);
			}
		}
		else
		{
			$errors = $val->show_errors();
			Session::set('message', $errors);
			return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
		}

		if($registrado)
		{
			$msg_ok = null;
			foreach ($registrado as $key => $idAluno)
			{
				$msg_ok .= $ra[$idAluno].', ';
			}
			Session::set('msgtype','success');
			Session::set('message', array('Registro salvo com sucesso! Aluno(s) RA: '. substr($msg_ok,0,-2)));
		}

		if($nao_registrado)
		{
			$msg_ok = null;
			foreach ($nao_registrado as $key => $idAluno)
			{
				$msg_fail .= $idAluno.', ';
			}
			Session::set('message', array('Erro ao salvar! Aluno(s) ID: '. substr($msg_fail,0,-2)));
		}

		return Response::redirect(Uri::base().'admin/atividades-alunos/busca');
	}

	private function datadb($data)
	{
		$datadb = '0000-00-00';

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