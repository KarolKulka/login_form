<?php
declare(strict_types = 1);

namespace App\Filters;

use App\Libraries\LoginVerification;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use CodeIgniter\Config\Services;

/**
 * Class UserFilter
 * Filter class to verify if user is logged in and have access to current url
 *
 * @package App\Filters
 */
class UserFilter implements FilterInterface
{
    /**
     * @var Session
     */
    protected Session $session;

    public function __construct()
    {
        $this->session = Services::session();
    }

    /**
     * Method verify if user is logged in by LoginVerification Class before he visit url
     *
     * @inheritDoc
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $loginVerification = new LoginVerification();

        if (!$loginVerification->verify()) {
            $this->session->set('filterAccessError', "You don't have access to this resource. Log in first!");
            return redirect('home.home');
        }
    }

    /**
     * @inheritDoc
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}
