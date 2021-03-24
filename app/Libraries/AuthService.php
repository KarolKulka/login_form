<?php
declare(strict_types = 1);

namespace App\Libraries;

use App\Entities\UserEntity;
use App\Models\UserModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Session\Session;
use ReflectionException;

/**
 * Class AuthService
 * Authorization class
 * @package App\Libraries
 */
class AuthService
{
    /**
     * @var Session
     */
    protected Session $session;

    /**
     * @var UserModel
     */
    protected UserModel $userModel;

    public function __construct()
    {
        $this->session = Services::session();
        $this->userModel = model('App\Models\UserModel');
    }

    /**
     * @param string $username
     * @return bool
     * @throws ReflectionException
     */
    public function LogInUser(string $username): bool
    {
        /** @var UserEntity $user */
        $user = $this->userModel->getUserByUsername($username);
        if (empty($user)){
            return false;
        }
        $user->setLastLogIn();
        $this->userModel->saveUser($user);

        $this->session->set('log_in_username', $user->getUsername());
        $this->session->set('log_in_time', md5($user->getLastLogInFormatted()));

        return true;
    }

    /**
     * Method verify if user is logged in by checking if username and md5 hash of login date exists in database
     *
     * @return bool
     */
    public function verifyLoggedUser(): bool
    {
        $sessionUsername = filter_var($this->session->get('log_in_username'), FILTER_SANITIZE_STRING);
        $sessionLogInTime = filter_var($this->session->get('log_in_time'), FILTER_SANITIZE_STRING);
        if (empty($sessionUsername) || empty($sessionLogInTime)) {
            return false;
        }

        $user = $this->userModel->getUserByUsernameAndHashedLogInDate($sessionUsername, $sessionLogInTime);

        if (empty($user)) {
            return false;
        }

        return true;
    }
}
