<?php

namespace App\Controllers;

use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use CodeIgniter\Validation\Validation;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form_helper'];

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var Validation
     */
    protected $validation;

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();

        $this->session = Services::session();
        $this->validation = Services::validation();
	}

	public function __construct()
    {
    }

    /**
     * Method for view render
     *
     * @param string $viewName
     * @param array $viewData
     * @return string
     */
    protected function renderView(string $viewName, array $viewData = []) : string
    {
        return view('header', $viewData) . view($viewName, $viewData) . view('footer', $viewData);
    }

    /**
     * Check if exists any errors from form validation or route filter
     *
     * @return array|null
     */
    protected function checkSubmitAndAccessErrors(): ?array
    {
        $output = [];
        $validationErrors = session()->get('validationErrors') ?? [];
        session()->remove('validationErrors');
        foreach ($validationErrors as $validationError){
            $output[] = $validationError;
        }
        $accessErrors = session()->get('filterAccessError');
        session()->remove('filterAccessError');
        if (!is_null($accessErrors)){
            $output[] = $accessErrors;
        }

        return $output;
    }
}
