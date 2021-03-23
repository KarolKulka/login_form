<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Entities\UserEntity;
use App\Libraries\LoginVerification;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;
use Psr\Log\LoggerInterface;

class Home extends BaseController
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var LoginVerification
     */
    protected LoginVerification $loginVerification;

    /**
     * Constructor.
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
    }

    public function __construct()
    {
        parent::__construct();
        $this->loginVerification = new LoginVerification();
    }

    public function index()
    {
        $data['validationErrors'] = $this->checkSubmitAndAccessErrors();
        $data['user'] = $this->checkIfLoggedIn();

        return $this->renderView(is_null($data['user']) ? 'start' : 'logged_start', $data);
	}

	public function login()
    {
        if ($this->validation->run(
            $this->request->getPost(null, FILTER_SANITIZE_STRING),
            'userLogin'
        )) {
            /** @var UserModel $userModel */
            $userModel = model('App\Models\UserModel');
            /** @var UserEntity $user */
            $user = $userModel->getUserByUsername($this->request->getPost('username', FILTER_SANITIZE_STRING));
            $user->setLastLogIn();
            $userModel->saveUser($user);

            $this->session->set('log_in_username', $user->getUsername());
            $loginDate = new DateTime();
            $this->session->set('log_in_time', md5($user->getLastLogInFormated()));
            return redirect('home.logged');
        }

        session()->set('validationErrors', $this->validation->getErrors());
        return redirect()->route('home.login');

    }

    /**
     * @return UserEntity|null
     */
    private function checkIfLoggedIn(): ?UserEntity
    {
        if (!$this->loginVerification->verify()){
            return null;
        }

        $sessionUsername = $this->session->get('log_in_username');
        $sessionLogInTime = $this->session->get('log_in_time');
        /** @var UserModel $userModel */
        $userModel = model('App\Models\UserModel');

        return $userModel->getUserByUsernameAndHashedLogInDate($sessionUsername, $sessionLogInTime);
    }

    public function logged()
    {
        $user = $this->checkIfLoggedIn();

        return $this->renderView('logged', ['user' => $user]);
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect()->route('home.home');
    }


}
