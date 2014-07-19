<?php

class Model_AtividadeAluno extends Orm\Model
{
	protected static $_table_name = 'atividade_has_aluno';

	protected static $_primary_key = array('idAtividadeAluno');

	protected static $_properties = array(
		'idAtividadeAluno',
		'idAtividade',
		'idAluno',
		'carga_horaria',
		'descricao',
		'data',
	);

	public static function validate()
	{
		$val = Validation::forge();

		$val->add_field('carga_horaria', 'CargaHoraria', 'required|valid_string[numeric]');
		$val->add('descricao');
		$val->add('data');

		return $val;
	}
}