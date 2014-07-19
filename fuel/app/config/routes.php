<?php
return array(
	'_root_'  => '404',
	'_404_'   => '404',

	'cadastrar'                         =>      'aluno/cadastrar',
	'login'                             =>      'aluno/login',
	'logout'                            =>      'aluno/logout',
	'relatorio/(:num)'                  =>      'aluno/relatorio/ver/$1',

	'admin/atividades-alunos/inserir'       =>      'admin/atividades/alunos/inserir',
	'admin/atividades-alunos/busca'         =>      'admin/atividades/alunos/busca',
	'admin/atividades-alunos/gerenciar'     =>      'admin/atividades/alunos/gerenciar',
	'admin/atividades-alunos/editar'        =>      'admin/atividades/alunos/editar',

	'admin/atividades-alunos/massa'             =>      'admin/atividades/alunos/massa',
	'admin/atividades-alunos/inserir/(:num)'    =>      'admin/atividades/alunos/inserir/$1',
	'admin/atividades-alunos/editar/(:num)'     =>      'admin/atividades/alunos/editar/$1',
	'admin/atividades-alunos/delete/(:num)'     =>      'admin/atividades/alunos/delete/$1',
	'admin/relatorio/(:num)'                    =>      'admin/relatorio/ver/$1',
);