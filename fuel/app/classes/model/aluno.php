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

class Model_Aluno extends Orm\Model
{
	protected static $_table_name = 'aluno';

	protected static $_primary_key = array('idAluno');

	protected static $_properties = array(
		'idAluno',
		'idCurso',
		'nome',
		'email',
		'ra',
		'senha',
	);

	protected static $_has_many = array(
		'cursos' => array(
			'key_from' => 'idCurso',
			'model_to' => 'Model_Curso',
			'key_to' => 'idCurso',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
	);

	protected static $_many_many = array(
		'atividades' => array(
			'key_from' => 'idAluno',
			'key_through_from' => 'idAluno',
			'table_through' => 'atividade_has_aluno',
			'key_through_to' => 'idAluno',
			'model_to' => 'Model_AtividadeAluno',
			'key_to' => 'idAluno',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	public static function validate()
	{
		$val = Validation::forge();

		$val->add_field('nome',  'nome',  'required|min_length[3]|max_length[200]');
		$val->add_field('email', 'email', 'required|valid_email');
		$val->add_field('ra',    'ra',    'required|valid_string[numeric]');
		$val->add('senha');

		return $val;
	}
}