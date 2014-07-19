<?php

class Model_CursoAtividade extends Orm\Model
{
	protected static $_table_name = 'curso_has_atividade';

    protected static $_primary_key = array('idCurso','idAtividade');

    protected static $_properties = array(
        'idCurso',
        'idAtividade',
    );
}