<?php

class Model_Curso extends Orm\Model
{
	protected static $_table_name = 'curso';

    protected static $_primary_key = array('idCurso');

    protected static $_properties = array(
    	'idCurso',
    	'nome',
    	'carga_horaria',
	);

    protected static $_many_many = array(
        'atividades' => array(
            'key_from' => 'idCurso',
            'key_through_from' => 'idAtividade',
            'table_through' => 'curso_has_atividade',
            'key_through_to' => 'idCurso',
            'model_to' => 'Model_Curso',
            'key_to' => 'idCurso', //Ultima alteração p/ Remover curos (idAtividade)
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );

    public static function validate()
    {
        $val = Validation::forge();

        $val->add_field('nome', 'Nome', 'required|min_length[3]|max_length[200]');
        $val->add_field('carga_horaria', 'CargaHoraria', 'required|valid_string[numeric]');

        return $val;
    }

}