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

class Controller_Base extends Controller
{
	public function before()
	{
		parent::before();
		if(Session::get('userid') != '46Xf0y7x7mYpnsGvtWa4mkNtZkJmdzc0aW0xSEtkcnQxUzgwSFhjbHVCdGdXUndYWndYOFc4MHZNUzQ')
		{
			Session::destroy();
			$data = array();
			$data['title'] = 'Login';
			$data['message'] = 'Acesso Restrito';
			return Response::redirect(Uri::base() . 'admin/login');
		}
	}
}