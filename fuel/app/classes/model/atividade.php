<?php

class Model_Atividade extends Orm\Model
{
	protected static $_table_name = 'atividade';

	protected static $_primary_key = array('idAtividade');

	protected static $_properties = array(
		'idAtividade',
		'nome',
		'carga_horaria',
		'data_atividade',
		'descricao',
	);

	protected static $_many_many = array(
		'cursos' => array(
			'key_from' => 'idAtividade',
			'key_through_from' => 'idAtividade',
			'table_through' => 'curso_has_atividade',
			'key_through_to' => 'idCurso',
			'model_to' => 'Model_Curso',
			'key_to' => 'idCurso',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	public static function validate()
	{
		$val = Validation::forge();

		$val->add_field('nome', 'Nome', 'required|min_length[3]|max_length[200]');
		$val->add_field('carga_horaria', 'CargaHoraria', 'required|valid_string[numeric]');
		$val->add('data_atividade');
		$val->add('descricao');

		return $val;
	}
}