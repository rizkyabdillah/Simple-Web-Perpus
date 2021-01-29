<?php

namespace App\Controllers;

use App\Models\CrudModel;
use CodeIgniter\Controller;

class BaseController extends Controller
{

	protected $helpers = ['form', 'session', 'text'];

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		session();
		$this->email = \Config\Services::email();
		$this->validation = \Config\Services::validation();
		$this->model = new CrudModel();
		parent::initController($request, $response, $logger);
	}
}
